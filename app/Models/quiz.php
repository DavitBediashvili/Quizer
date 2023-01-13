<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class quiz extends Model
{
    use HasFactory;

    protected $table = "quizzes";
    
    protected $fillable = [
        "name",
        "url",
        "creator_name",
        "desc",
        "showing"
    ];

}
