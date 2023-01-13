<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    protected $table = "questions";
    
    protected $fillable = [
        "question",
        "url",
        "position",
        "answer_id",
        "quiz_id"
    ];
}
