<?php

namespace App\Repositories;

use App\Interfaces\MeetingInterface;
use App\Models\Meeting\Meeting;
use Carbon,
    DateTime;
use Auth;

class MeetingRepository implements MeetingInterface {

    /**
     * @var Model
     */
    protected $model;

    /**
     * MeetingRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Meeting $model) {
        $this->model = $model;
    }

    /**
     * Function : Get All Meetings
     * @param NA
     * @return Meetings
     */
    public function meetings() {
        return $this->model->latest()->paginate(1);
    }

    /**
     * Function : Create Meeting
     *
     * @param [type] $request
     * @return Meeting
     */
    public function create($request) {
        /**
         * using of this method self::__duration,
         * we can also use helper where placed  hole code
         */
        return $this->model->create([
                    'userId' => Auth::id(),
                    'subject' => $request->subject,
                    'startDateTime' => self::__Carbon($request->startDateTime, 'Y-m-d h:i:s'),
                    'endDateTime' => self::__Carbon($request->endDateTime, 'Y-m-d h:i:s'),
                    'duration' => self::__duration($request->startDateTime, $request->endDateTime)
        ]);
    }

    /**
     * Function : Get Meeting By Id
     * @param [type] $id
     * @return Meeting
     */
    public function meetingById($id) {
        return $this->model->find($id);
    }

    /**
     * Function : Update Meeting
     *
     * @param [type] $request
     * @param [type] $id
     * @return Meeting
     */
    public function update($request, $id) {
        $meeting = $this->model->find($id);
        if ($meeting):
            $meeting->userId = Auth::id();
            $meeting->subject = $request->subject;
            $meeting->startDateTime = self::__Carbon($request->startDateTime, 'Y-m-d h:i:s');
            $meeting->endDateTime = self::__Carbon($request->endDateTime, 'Y-m-d h:i:s');
            $meeting->duration = self::__duration($request->startDateTime, $request->endDateTime);
            $meeting->update();
            return $meeting;
        endif;
    }

    /**
     * Function : Delete Meeting
     * @param [type] $id
     * @return void
     */
    public function delete($id) {
        $meeting = $this->model->find($id);
        if ($meeting):
            return $meeting->delete();
        endif;
    }

    private static function __duration($startDateTime, $endDateTime) {
        $start = Carbon\Carbon::parse($startDateTime)->setTimezone('UTC');
        $end = Carbon\Carbon::parse($endDateTime)->setTimezone('UTC');
        return $start->diff($end)->format('%H:%I:%S');
    }

    private static function __Carbon($parse, $format) {
        return Carbon\Carbon::parse($parse)->format((!empty($format) ? $format : 'Y-m-d'));
    }

}
