<?php

namespace App\Interfaces;

interface AttendeeInterface {

    public function attendees();

    public function create($request);

    public function attendeeById($attendeeId);

    public function update($request, $attendeeIdz);

    public function delete($attendeeId);
}
