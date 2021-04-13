<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'morphy_grammema_gender';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
