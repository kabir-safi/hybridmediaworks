<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model {

    use HasFactory;

    protected $fillable = ['userId', 'attendee'];

    public function meetings() {
        return $this->belongsToMany(Meeting::class, 'attendee_meeting_users', 'attendeeId', 'meetingId');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'attendee_meeting_users', 'attendeeId', 'userId');
    }

//    public function attendee_meeting_users() {
//        return $this->belongsToMany(Meeting::class, 'attendee_meeting_users', 'meetingId', 'userId', 'attendeeId');
//    }
}
