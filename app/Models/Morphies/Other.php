<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $table = 'morphy_grammema_other';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
