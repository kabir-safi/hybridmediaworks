<?php

namespace App\Models\Meeting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
use Hash;

class User extends Model {

    use HasFactory;

    protected $fillable = ['name', 'email'];

}
