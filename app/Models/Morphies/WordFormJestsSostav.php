<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordFormJestsSostav extends Model
{
    use HasFactory;

    protected $table = 'morphy_wordform_jests_sostav';

    public $timestamps = false;

    protected $fillable = ['wordform_id', 'jest_id', 'order'];
}
