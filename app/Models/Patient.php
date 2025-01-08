<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'patientId';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'controlNumber',
        'career',
        'schoolCycle'
    ];

    // Relationship with test results
    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'patientId');
    }
}
