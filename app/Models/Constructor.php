<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    use HasFactory;

    protected $table = 'constructor';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string'; 
    public $timestamps = false;
}
