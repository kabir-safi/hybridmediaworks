<?php

namespace App\Models\MeetingApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendeeMeetingUser extends Model {

    use HasFactory;

    protected $fillable = ['id', 'attendeeId', 'meetingId', 'userId'];

    protected static function __create($attendeeId, $meetingId, $userId) {
        return self::create([
                    'attendeeId ' => $attendeeId,
                    'meetingId' => $meetingId,
                    'userId' => $userId
        ]);
    }

}
