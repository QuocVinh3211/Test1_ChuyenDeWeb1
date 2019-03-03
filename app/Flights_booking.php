<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flights_booking extends Model
{
    protected $table = 'flights_booking';
    protected $fillable = ['booking_id', 'user_email', 'flight_id', 'cus_title', 'cus_name',
    'total_price', 'payment', 'card_number', 'card_name', 'ccv_code'];
    public $timestamps = false;
}
