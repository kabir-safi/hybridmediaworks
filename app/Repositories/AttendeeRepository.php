<?php

namespace App\Repositories;

use App\Interfaces\AttendeeInterface;
use App\Models\Meeting\Attendee;
use Auth;

class AttendeeRepository implements AttendeeInterface {

    /**
     * @var Model
     */
    protected static $model;

//    protected  $model;

    /**
     * AttendeeRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Attendee $model) {
        self::$model = $model;
//        $this->$model = $model;
    }

    /**
     * Function : Get All Attendees
     * @param NA
     * @return Attendees
     */
    public function attendees() {
        
    }

    /**
     * Function : Create Attendee
     *
     * @param [type] $request
     * @return Attendee
     */
    public function create($request) {
        // $this->$model->create();
        /**
         *  remove duplication of email and store unique email in attendees table
         * should be table format of column attendee 
         * store data in bitch ,check if email exists not insert otherwise do
         * form input name should be @attendee[] / @attendees[] 
         */
        $attendees = array();
        foreach ($request->attendees as $attendee):
            $row_set = self::$model->where('attendee', $attendee)->first();
            if (empty($row_set)):
                $attendees[] = self::$model->create(['attendee' => $attendee, 'userId' => Auth::id()])->id;
            else:
                $attendees[] = $row_set->id;
            endif;
        endforeach;
        return $attendees;
    }

    /**
     * Function : Get Attendee By Id
     * @param [type] $id
     * @return Attendee
     */
    public function attendeeById($id) {
        
    }

    /**
     * Function : Update Attendee
     *
     * @param [type] $request
     * @param [type] $id
     * @return Attendee
     */
    public function update($request, $attendeeIdz) {
        $attendees = array();
        foreach ($attendeeIdz as $attendeeKey => $attendee):
            $row_set = self::$model->where('attendee', $request->attendees[$attendeeKey])->first();
            if (empty($row_set)):
                $attendee->attendee = $request->attendees[$attendeeKey];
                $attendees[] = $attendee->update();
            else:
                $attendees[] = $row_set->id;
            endif;
        endforeach;
        return $attendees;
    }

    /**
     * Function : Delete Attendee
     * @param [type] $id
     * @return void
     */
    public function delete($id) {
        $attendee = self::$model->find($id);
        if ($attendee):
            return $attendee->delete();
        endif;
    }

}
