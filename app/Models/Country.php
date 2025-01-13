<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'country'; // Match your table name
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string'; 
    public $timestamps = false; // Disable timestamps if they are not used
}
