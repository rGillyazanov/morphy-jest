<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartOfSpeech extends Model
{
    use HasFactory;

    protected $table = 'morphy_parts_of_speech';

    protected $fillable = ['descriptor', 'description'];
}
