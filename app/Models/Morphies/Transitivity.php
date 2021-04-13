<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transitivity extends Model
{
    protected $table = 'morphy_grammema_transitivity';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
