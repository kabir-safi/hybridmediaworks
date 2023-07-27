<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeetingApp\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller {

    private static $errorType = false;
    private static $message = '';

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $users = User::latest()->paginate(5);
        return view('meetingapp.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        //call __create from User model
        try {
            self::rules($request);
            User::__create($request);
            self::$errorType = false;
            self::$message = 'User has been save successfully';
        } catch (\Exception $e) {
            self::$errorType = true;
            self::$message = $e->getMessage();
        }
        return redirect('show-all-users')->with(['errorType' => self::$errorType, 'message' => self::$message]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

    protected function rules($request) {
        return $request->validate([
                    'email' => 'required|email|unique:users',
                    'name' => 'required|string|max:25',
                    'password' => 'required|string|min:6',
        ]);
    }

}
