<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';
    protected $primaryKey = 'noteId';
    public $timestamps = false;

    protected $fillable = [
        'userId',
        'title',
        'description',
        'createdAt'
    ];

    public function user()
    {
        // return $this->belongsTo(User::class, 'userId');
    }
}
