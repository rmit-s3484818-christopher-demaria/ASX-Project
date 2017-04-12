<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asxList extends Model
{
    protected $table = "askList";
    protected $fillable = ['id', 'symbol', 'name','updated_at'];
}
