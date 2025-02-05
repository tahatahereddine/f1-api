<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string'; 
    public $timestamps = false;
}
