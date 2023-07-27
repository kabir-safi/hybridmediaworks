<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meeting\User;

class Meeting extends Model {

    use HasFactory;

    protected $fillable = ['userId', 'subject', 'startDateTime', 'endDateTime', 'duration'];

    public function attendees() {
        return $this->belongsToMany(Attendee::class, 'meeting_attendees', 'meetingId', 'attendeeId');
    }

    public function meetingUserInfo() {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

}
