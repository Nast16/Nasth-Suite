<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'type', 'has_inventory', 'has_cashbook', 'has_tasks'];
}
