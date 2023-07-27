@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-4">
                    <!--create new user--> 
                    @if ($message = Session::get('message'))
                    <div class="alert alert-{{(Session::get('errorType') == false) ? 'success': 'danger'}}">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <form id="form-meeting" action="create-new-user" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="user-name">User Name</label>
                                                <input type="text" id="edit-name" name="name" class="form-control" required="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="edit-email" name="email" class="form-control" required="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="edit-password" name="password" class="form-control" required="true"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <button id="btn-create-new-user" class="btn btn-info btn-sm btn-submit btn-create-new-user"> <i class="fas fa-save"></i>Create New User</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--display all users record--> 
                <div class="col-lg-7">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="1%">S.No</th>
                                <th scope="col" width="15%">Username</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
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
    </div>
</div>
@stop
