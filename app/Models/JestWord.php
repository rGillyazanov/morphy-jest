<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JestWord extends Model
{
    protected $table = 'srd_surd_cross_words';

    protected $primaryKey = 'id_word';

    protected $fillable = ['id_word', 'id_jest'];

    public $timestamps = false;

    public function jest()
    {
        return $this->belongsTo(Jest::class, 'id_jest', 'id_jest');
    }

    public function word()
    {
        return $this->belongsTo(Jest::class, 'id_word', 'id_jest');
    }
}
