<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    protected $table = 'configs';
    protected $fillable = ['key', 'value', 'created_at', 'updated_at', 'deleted_at'];
}
