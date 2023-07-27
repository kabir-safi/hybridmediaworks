<?php

namespace App\Interfaces;

interface MeetingInterface {

    public function meetings();

    public function create($request);

    public function meetingById($meetingId);

    public function update($request, $meetingId);

    public function delete($meetingId);
}
