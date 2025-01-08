<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'eventId';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
