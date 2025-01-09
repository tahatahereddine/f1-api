<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonDriverFull extends Model
{
    use HasFactory;

    protected $table = 'season_driver_full';
    public $timestamps = false;

    protected $fillable = [
        'year',
        'position_number',
        'points',
        'driver_id',
        'constructor_id',
        'country_id',
        'constructor_name',
        'driver_name',
        'nationality_code'
    ];
}
