<?php

namespace App\Interfaces;

interface CalendarInterface {

    public function getAllCalendarEvents();

    public function store($request);

    public function calendarById($calendarId);

    public function update($request, $calendarId);

    public function delete($calendarId);
}
