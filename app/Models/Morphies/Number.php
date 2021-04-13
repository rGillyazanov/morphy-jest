<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $table = 'morphy_grammema_number';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
