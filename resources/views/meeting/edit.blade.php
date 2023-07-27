@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-4">
                    <!--create new meeting--> 
                    @if ($message = Session::get('message'))
                    <div class="alert alert-{{(Session::get('errorType') == false) ? 'success': 'danger'}}">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <form id="form-meeting" action="/update-meeting" method="post" accept-charset="utf-8">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit-id" name="id"  value="{{ $meeting->id }}" class="form-control"/>
                        <div class="modal-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" id="edit-subject" name="subject"  value="{{ $meeting->subject }}" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                @foreach($meeting->attendees as $attendeeKey => $attendee)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="attendee-{{($attendeeKey + 1)}}">Attendee {{($attendeeKey + 1)}}</label>
                                            <input type="email" id="edit-attendee" name="attendees[]" value="{{ $attendee->attendee }}" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="start-date-time">Start Date Time</label>
                                            <input type="date" id="edit-start-date-time" name="startDateTime" class="form-control"  value="{{ $meeting->startDateTime }}" required="true" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="end-datetime">End Date Time</label>
                                            <input type="date" id="edit-end-date-time" name="endDateTime" class="form-control" value="{{ $meeting->endDateTime }}" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <button id="btn-update-meeting" class="btn btn-info btn-sm btn-submit btn-update-meeting"> <i class="fas fa-save"></i>Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
