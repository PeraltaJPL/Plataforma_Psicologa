<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'questionId';
    public $timestamps = true;

    protected $fillable = [
        'testId',
        'question_text',
        'type'
    ];

    // Relación con el test
    public function test()
    {
        return $this->belongsTo(Test::class, 'testId');
    }

    // Relación con opciones
    public function options()
    {
        return $this->hasMany(Option::class, 'questionId');
    }
}
