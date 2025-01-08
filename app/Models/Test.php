<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests';
    protected $primaryKey = 'testId';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'guide'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'testId');
    }

    // Relationship with test results
    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'testId');
    }
}
