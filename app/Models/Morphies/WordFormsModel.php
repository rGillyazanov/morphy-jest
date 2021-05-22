<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordFormsModel extends Model
{
    use HasFactory;

    protected $table = 'morphy_word_forms';

    public $timestamps = false;

    protected $fillable = ['word'];
}
