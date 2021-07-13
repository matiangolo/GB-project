<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    // Note: Questions have a type, the type is an integer that starts with 1
    // 1: Yes/No question
    // 2: Open question (the answer can be any text)
    // 3: ...

    // 2021-06-25: Only type 1 is supported
}
