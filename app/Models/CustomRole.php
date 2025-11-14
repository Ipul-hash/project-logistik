<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomRole extends Model
{
    protected $table = 'custom_roles';

    protected $fillable = ['name', 'description'];
}
