<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonConstructorFull extends Model
{
    use HasFactory;

    protected $table = 'season_constructor_full'; // Match the new table name
    public $timestamps = false; // Disable timestamps

}
