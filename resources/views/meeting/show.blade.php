@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" >Subject</th>
                        <th scope="col">Start Date Time</th>
                        <th scope="col">End Date Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Meeting Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $meeting->subject }}</td>
                        <td>{{ $meeting->startDate }}T{{ $meeting->startTime }}</td>
                        <td>{{ $meeting->endDate }}T{{ $meeting->endTime }}</td>
                        <td>{{ $meeting->duration }}</td>
                        <td><a href="{{ $meeting->meetingLink }}" target="blank">Meeting Link</a></td>
                    </tr>
                    <tr> <th scope="col" >Attendees</th></tr>
                    @foreach($meeting->attendees as $attendeeKey => $attendee)
                    <tr>
                        <td>{{($attendeeKey + 1)}} : {{ $attendee->attendee }}</td>
                    </tr>
                    @endforeach
                    <tr> <th scope="col" >Created By</th></tr>
                    <tr>
                        <td>{{ $meeting->meetingUserInfo->name }}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/edit-meeting/{{$meeting->id}}" class="btn btn-sm btn-success">Edit</a>
                            <a href="/destroy-meeting/{{$meeting->id}}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
