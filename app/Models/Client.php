<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname', 'due_day', 'amount'
    ];

    public function phone(){
        return $this->hasOne(Phone::class);
    }

    public function email(){
        return $this->hasOne(Email::class);
    }
}
