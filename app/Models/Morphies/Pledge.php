<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $table = 'morphy_grammema_pledge';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
