<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $primaryKey = 'sessionId';
    public $timestamps = false;

    protected $fillable = [
        'userId',
        'startDate',
        'endDate'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
