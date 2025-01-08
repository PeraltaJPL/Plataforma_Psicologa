<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $table = 'test_results'; // Nombre de la tabla
    protected $primaryKey = 'resultId'; // Clave primaria
    public $timestamps = false; // Desactiva los timestamps

    protected $fillable = [
        'testId',
        'patientId',
        'userId',
        'result',
        'testDate',
    ];

    // Relación con tests
    public function test()
    {
        return $this->belongsTo(Test::class, 'testId');
    }

    // Relación con pacientes
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientId');
    }

    // Relación con test_answers
    public function testAnswers()
    {
        return $this->hasMany(TestAnswer::class, 'resultId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

}
