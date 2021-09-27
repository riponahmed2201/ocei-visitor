<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorRegistration extends Model
{
    protected $table = 'visitor_registration';

    protected $fillable = ['name', 'email', 'phome', 'address', 'password', 'image', 'status'];
}
