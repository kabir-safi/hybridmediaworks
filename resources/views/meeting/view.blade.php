@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div container mt-3>
            <a href="create-new-meeting" class="btn  btn-sm btn-success"><i class="fas fa-users"></i> Add Meeting</a>
        </div>
    </div>
    <div class="row">
        <div class="container mt-5">
            @if ($message = Session::get('message'))
            <div class="alert alert-{{(Session::get('errorType') == 'false') ? 'success': 'danger'}}">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" >S.No</th>
                        <th scope="col" >Subject</th>
                        <th scope="col">Start Date Time</th>
                        <th scope="col">End Date Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Meeting Link</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    <tr>
                        <th scope="row">{{ $meeting->id }}</th>
                        <td>{{ $meeting->subject }}</td>
                        <td>{{ $meeting->startDateTime }}</td>
                        <td>{{ $meeting->endDateTime }}</td>
                        <td>{{ $meeting->duration }}</td>
                        <td><a href="{{ $meeting->meetingLink }}" target="blank">Meeting Link</a></td>
                        <td>
                            <a href="view-meeting/{{$meeting->id}}" class="btn btn-sm btn-info">View</a>
                            <a href="edit-meeting/{{$meeting->id}}" class="btn btn-sm btn-success">Edit</a>
                            <a href="destroy-meeting/{{$meeting->id}}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                {!! $meetings->links() !!}
            </div>
        </div>
    </div>
</div>
@stop
