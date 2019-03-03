<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List_cities extends Model
{
    protected $table = 'list_cities';
    protected $fillable = ['city_id', 'city_name', 'city_code'];
    public $timestamps = false;
}
