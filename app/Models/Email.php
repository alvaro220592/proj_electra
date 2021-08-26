<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'client_id'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
