<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $fillable = ['street', 'cep', 'district_id'];

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }
}
