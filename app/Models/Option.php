<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';
    protected $primaryKey = 'optionId';
    public $timestamps = true;

    protected $fillable = [
        'questionId',
        'optionText',
        'isCorrect'
    ];

    // Relación con la pregunta
    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }
}
