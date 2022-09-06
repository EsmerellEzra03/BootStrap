<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'attachment',
        'uuid',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
