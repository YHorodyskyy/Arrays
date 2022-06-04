<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArraySort extends Model
{
    protected $table = "arrays";
    protected $fillable = ["input_array", "output_array", "sort_type"];
    use HasFactory;
}
