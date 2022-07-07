<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment_type extends Model
{
    use HasFactory;

    public $table ='equipment_types';

    protected $fillable = ['id', 'type_name', 'serial_mask'];

}
