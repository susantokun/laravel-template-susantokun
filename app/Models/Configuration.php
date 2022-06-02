<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Configuration extends Model
{
    use HasFactory;

    protected $table      = 'configurations';
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
