<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use App\Interfaces\MeetingInterface;
use App\Interfaces\AttendeeInterface;
use App\Interfaces\CalendarInterface;
use Illuminate\Http\Request;

class MeetingController extends Controller {

    private $meetingInterface;
    private $attendeeInterface;
    private $calendarInterface;

    public function __construct(MeetingInterface $meetingInterface, AttendeeInterface $attendeeInterface, CalendarInterface $calendarInterface) {
        $this->middleware('auth');
        $this->meetingInterface = $meetingInterface;
        $this->attendeeInterface = $attendeeInterface;
        $this->calendarInterface = $calendarInterface;
    }

    /**
     * Display all meetings.
     */
    public function index() {
        $meetings = $this->meetingInterface->meetings();
        return view('meeting.view', compact('meetings'));
    }

    /**
     * Show the form for creating a new meeting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('meeting.create');
    }

    /**
     * Store a newly created meeting in storage/database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        $validation = $this->validate($request, [
//            'departure_date' => 'required|date|after:now',
//            'return_date' => 'required|date|after:departure_date',
//        ]);
        try {
            $event = $this->calendarInterface->store($request);
            if ($event->status):
                $meeting = $this->meetingInterface->create($request);
                $attendee = $this->attendeeInterface->create($request);
                $meeting->attendees()->attach($attendee);
                $meeting->meetingLinkId = $event->id;
                $meeting->meetingLink = $event->htmlLink;
                $meeting->update();
                return redirect('show-all-meetings')->with(['errorType' => true, 'message' => 'Success! Meeting has been save successfully Added']);
            else:
                return back()->with(['errorType' => false, 'message' => 'Failed! unable to create Meeting']);
            endif;
        } catch (Exception $e) {
            return back()->with(['errorType' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified show.
     */
    public function show($id) {
        $meeting = $this->meetingInterface->meetingById($id);
        return view('meeting.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified edit.
     */
    public function edit($id) {
        $meeting = $this->meetingInterface->meetingById($id);
        return view('meeting.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        try {
            $meeting = $this->meetingInterface->update($request, $request->id);
            $attendee = $this->attendeeInterface->update($request, $meeting->attendees);
            if ($attendee):
                $event = $this->calendarInterface->update($request, $meeting->meetingLinkId);
                if ($event->status):
                    $meeting->meetingLink = $event->htmlLink;
                    $meeting->update();
                endif;
                return redirect('show-all-meetings')->with(['errorType' => true, 'message' => 'Success! Meeting has been save successfully Updated']);
            else:
                return back()->with(['errorType' => false, 'message' => 'Failed! unable to Update Meeting']);
            endif;
        } catch (Exception $e) {
            return back()->with(['errorType' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            $meeting = $this->meetingInterface->meetingById($id);
            $event = $this->calendarInterface->delete($meeting->meetingLinkId);
            if ($event->status):
                if (!empty($meeting->attendees)):
                    foreach ($meeting->attendees as $attendee):
                        $meeting->attendees()->detach($attendee->id);
//                            $this->attendeeInterface->delete($attendee->id);
                    endforeach;
                    $this->meetingInterface->delete($id);
                endif;
                return redirect('show-all-meetings')->with(['errorType' => true, 'message' => 'Success! Meeting has been save successfully Delete']);
            else:
                return back()->with(['errorType' => false, 'message' => 'Failed! unable to Delete Meeting']);
            endif;
        } catch (Exception $e) {
            return back()->with(['errorType' => false, 'message' => $e->getMessage()]);
        }
    }

}
