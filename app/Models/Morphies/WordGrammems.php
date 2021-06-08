<?php

namespace App\Models\Morphies;

use App\Models\Jest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordGrammems extends Model
{
    use HasFactory;

    protected $table = 'morphy_word_grammems';

    public $timestamps = false;

    protected $fillable = [
        'base_word_form_id', 'word_id', 'part_of_speech_id', 'gender_id', 'number_id', 'case_id', 'time_id', 'face_id', 'enthusiasm_id',
        'view_id', 'transitivity_id', 'pledge_id', 'other_id', 'semantic_feature_id'
    ];

    public function jests()
    {
        return $this->belongsToMany(Jest::class, 'morphy_jest_wordforms', 'wordform_id', 'jest_id');
    }

    public function baseForm()
    {
        return $this->belongsTo(WordFormsModel::class, 'base_word_form_id', 'id');
    }

    public function word()
    {
        return $this->belongsTo(WordFormsModel::class, 'word_id', 'id');
    }

    public function partOfSpeech()
    {
        return $this->belongsTo(PartOfSpeech::class, 'part_of_speech_id', 'id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    public function number()
    {
        return $this->belongsTo(Number::class, 'number_id', 'id');
    }

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id', 'id');
    }

    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id', 'id');
    }

    public function face()
    {
        return $this->belongsTo(Face::class, 'face_id', 'id');
    }

    public function enthusiasm()
    {
        return $this->belongsTo(Enthusiasm::class, 'enthusiasm_id', 'id');
    }

    public function view()
    {
        return $this->belongsTo(View::class, 'view_id', 'id');
    }

    public function transitivity()
    {
        return $this->belongsTo(Transitivity::class, 'transitivity_id', 'id');
    }

    public function pledge()
    {
        return $this->belongsTo(Pledge::class, 'pledge_id', 'id');
    }

    public function other()
    {
        return $this->belongsTo(Other::class, 'other_id', 'id');
    }

    public function semantic_feature()
    {
        return $this->belongsTo(SemanticFeature::class, 'semantic_feature_id', 'id');
    }

    public function json($otherParams = [])
    {
        $result = [];
        foreach ($this->getAttributes() as $key => $attribute) {
            if ($key == 'word_id') {
                $result['Слово'] = mb_strtoupper($this->word->word, 'UTF-8');
            } else if ($key === 'part_of_speech_id') {
                $result['Часть речи'] = mb_strtoupper($this->partOfSpeech->descriptor, 'UTF-8');
            } else if ($attribute) {
                switch ($key) {
                    case 'gender_id':
                        $result['Граммемы'][] = mb_strtoupper($this->gender->grammema, 'UTF-8');
                        break;
                    case 'number_id':
                        $result['Граммемы'][] = mb_strtoupper($this->number->grammema, 'UTF-8');
                        break;
                    case 'case_id':
                        $result['Граммемы'][] = mb_strtoupper($this->case->grammema, 'UTF-8');
                        break;
                    case 'time_id':
                        $result['Граммемы'][] = mb_strtoupper($this->time->grammema, 'UTF-8');
                        break;
                    case 'face_id':
                        $result['Граммемы'][] = mb_strtoupper($this->face->grammema, 'UTF-8');
                        break;
                    case 'enthusiasm_id':
                        $result['Граммемы'][] = mb_strtoupper($this->enthusiasm->grammema, 'UTF-8');
                        break;
                    case 'view_id':
                        $result['Граммемы'][] = mb_strtoupper($this->view->grammema, 'UTF-8');
                        break;
                    case 'transitivity_id':
                        $result['Граммемы'][] = mb_strtoupper($this->transitivity->grammema, 'UTF-8');
                        break;
                    case 'pledge_id':
                        $result['Граммемы'][] = mb_strtoupper($this->pledge->grammema, 'UTF-8');
                        break;
                    case 'other_id':
                        $result['Граммемы'][] = mb_strtoupper($this->other->grammema, 'UTF-8');
                        break;
                    case 'semantic_feature_id':
                        $result['Граммемы'][] = mb_strtoupper($this->semantic_feature->grammema, 'UTF-8');
                        break;
                }
            }
        }

        if (isset($result['Граммемы'])) {
            sort($result['Граммемы']);
        }

        $result = [
            'Слово' => $result['Слово'],
            'Граммемы' => isset($result['Граммемы']) ? $result['Граммемы'] : [],
            'Часть речи' => $result['Часть речи'],
        ];

        if ($otherParams) {
            $result += $otherParams;
        }

        return $result;
    }
}
