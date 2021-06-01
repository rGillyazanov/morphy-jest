<?php

namespace App\Models\Morphies;

use App\Models\Jest;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordFormJestsSostav extends Model
{
    use HasFactory;

    protected $table = 'morphy_wordform_jests_sostav';

    public $timestamps = false;

    protected $fillable = ['word_id', 'wordform_id', 'jest_id', 'order'];

    public function word()
    {
        return $this->belongsTo(Word::class, 'word_id', 'id_word');
    }

    public function wordForm()
    {
        return $this->belongsTo(WordFormsModel::class, 'wordform_id', 'id');
    }

    public function jest()
    {
        return $this->belongsTo(Jest::class, 'jest_id', 'id_jest');
    }
}
