<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asx extends Model
{
    protected $fillable = ['id', 'symbol', 'name','company','updated_at'];
}
