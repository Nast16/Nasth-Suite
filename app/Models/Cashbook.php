<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Cashbook extends Model
{
    protected $fillable = ['type', 'amount', 'description', 'organization_id'];
}
