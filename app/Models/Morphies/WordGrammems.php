<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordGrammems extends Model
{
    use HasFactory;

    protected $table = 'morphy_word_grammems';

    public $timestamps = false;

    protected $fillable = [
        'word_id', 'part_of_speech_id', 'gender_id', 'number_id', 'case_id', 'time_id', 'face_id', 'enthusiasm_id',
        'view_id', 'transitivity_id', 'pledge_id', 'other_id', 'semantic_feature_id'
    ];
}
