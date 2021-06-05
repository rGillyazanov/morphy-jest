<?php

namespace App\Models\Morphies;

use App\Models\Jest;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JestWordForms extends Model
{
    use HasFactory;

    protected $table = 'morphy_jest_wordforms';

    public $timestamps = false;

    protected $fillable = [
        'jest_id', 'word_id', 'wordform_id'
    ];

    public function jest()
    {
        return $this->belongsTo(Jest::class, 'jest_id', 'id_jest');
    }

    public function word()
    {
        return $this->belongsTo(Word::class, 'word_id', 'id_word');
    }

    public function wordForm()
    {
        return $this->belongsTo(WordGrammems::class, 'wordform_id', 'id');
    }
}
