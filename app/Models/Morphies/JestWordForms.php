<?php

namespace App\Models\Morphies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JestWordForms extends Model
{
    use HasFactory;

    protected $table = 'morphy_jest_wordforms';

    public $timestamps = false;

    protected $fillable = [
        'jest_id', 'wordform_id'
    ];
}
