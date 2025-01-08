<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    use HasFactory;
    protected $table = 'test_answers';
    protected $primaryKey = 'answerId';
    public $timestamps = true;

    protected $fillable = ['resultId', 'questionId', 'optionId', 'answerText', 'userId', 'value'];

    // Relación con test_results
    public function testResult()
    {
        return $this->belongsTo(TestResult::class, 'resultId');
    }

    // Relación con questions
    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }

    // Relación con options
    public function option()
    {
        return $this->belongsTo(Option::class, 'optionId');
    }
}

