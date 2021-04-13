<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'morphy_grammema_view';

    protected $fillable = ['grammema', 'description'];

    use HasFactory;
}
