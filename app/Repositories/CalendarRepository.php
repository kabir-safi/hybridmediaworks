<?php

namespace App\Repositories;

use App\Interfaces\CalendarInterface;
use Spatie\GoogleCalendar\Event;
use Carbon;

class CalendarRepository implements CalendarInterface {

    /**
     * Function : Get All Calendar Event
     * @param NA
     * @return Calendar
     */
    public function getAllCalendarEvents() {
        try {
            return Event::get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Function : Create Calendar
     *
     * @param [type] $request
     * @return Calendar
     */
    public function store($request) {
        try {
            $event = new Event;
            $event->name = $request->subject;
            $event->startDateTime = Carbon\Carbon::parse($request->startDateTime)->setTimezone('UTC');
            $event->endDateTime = Carbon\Carbon::parse($request->endDateTime)->setTimezone('UTC');
            foreach ($request->attendees as $attendee):
                $event->addAttendee(['email' => $attendee]);
            endforeach;
            return $event->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Function : Get Calendar By Id
     * @param [type] $id
     * @return Calendar
     */
    public function calendarById($id) {
        
    }

    /**
     * Function : Update Calendar
     *
     * @param [type] $request
     * @param [type] $id
     * @return Calendar
     */
    public function update($request, $id) {
        try {
            $event = Event::find($id);
            $event->name = $request->subject;
            $event->startDateTime = Carbon\Carbon::parse($request->startDateTime)->setTimezone('UTC');
            $event->endDateTime = Carbon\Carbon::parse($request->endDateTime)->setTimezone('UTC');
            foreach ($request->attendees as $attendee):
                $event->addAttendee(['email' => $attendee]);
            endforeach;
            return $event->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Function : Delete Calendar
     * @param [type] $id
     * @return void
     */
    public function delete($id) {
        try {
            $event = Event::find($id);
            if ($event):
                $event->delete();
                return $event;
            endif;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
