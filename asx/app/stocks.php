<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stocks extends Model
{
    protected $table = "stocks";
    protected $fillable = ['symbol', 'name','price','perChange','updated_at'];
}
