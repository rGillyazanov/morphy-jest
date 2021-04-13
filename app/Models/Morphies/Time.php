<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'morphy_grammema_time';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
