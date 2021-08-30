<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class period extends Model
{
    use HasFactory;
    protected $table = "periods";
    protected $fillable = [
        "level",
        "day",
        "7-8",
        "8-9",
        "9-10",
        "10-11",
        "11-12",
        "12-01",
        "01-02",
        "02-03",
        "03-04",
        "04-05"
    ];
}
