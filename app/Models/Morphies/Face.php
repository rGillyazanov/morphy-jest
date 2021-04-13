<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    protected $table = 'morphy_grammema_face';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
