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
                    <form id="form-meeting" action="add-new-meeting" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" id="edit-subject" name="subject" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="attendee-one">Attendee 1</label>
                                            <input type="email" id="edit-attendee" name="attendees[]" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="attendee-two">Attendee 2</label>
                                            <input type="email" id="edit-attendee-two" name="attendees[]" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="start-date-time">Start Date Time</label>
                                            <input type="datetime-local" id="edit-start-date" name="startDateTime" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="end-date-time">End Date Time</label>
                                            <input type="datetime-local" id="edit-end-date" name="endDateTime" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <button id="btn-create-new-meeting" class="btn btn-info btn-sm btn-submit btn-create-new-meeting"> <i class="fas fa-save"></i>Create</button>
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
