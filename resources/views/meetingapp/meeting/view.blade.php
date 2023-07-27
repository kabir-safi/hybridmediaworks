@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div container mt-3>
            <button type="button" class="btn  btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#edit-modal"><i class="fas fa-users"></i> Add Meeting </button>
        </div>
    </div>
    <div class="row">
        <div class="container mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="1%">#</th>
                        <th scope="col" width="15%">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" width="10%">Username</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Meeting</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <form id="form-meeting" action="{{ route('meeting.store') }}" method="post" accept-charset="utf-8">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="attendee-one">Attendee 1</label>
                                        <input type="email" id="edit-attendee" name="attendeeOne" class="form-control" required="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="attendee-two">Attendee 2</label>
                                        <input type="email" id="edit-attendee-two" name="attendeeTwo" class="form-control" required="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="start-date">Date</label>
                                        <input type="date" id="edit-start-date" name="startDate" class="form-control" required="true" />
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="start-time">Time</label>
                                        <input type="time" id="edit-start-time" name="startTime" class="form-control" required="true" />
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="end-date">End Date</label>
                                                                    <input type="date" id="edit-end-date" name="endDate" class="form-control" required="true" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="end-time">End Time</label>
                                                                    <input type="time" id="edit-end-time" name="endTime" class="form-control" required="true" />
                                                                </div>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="add-new-meeting" class="btn btn-info btn-sm btn-submit add-new-meeting"> <i class="fas fa-save"></i>Save Meeting</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
