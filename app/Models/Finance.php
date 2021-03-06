<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    public $table = 'uctc_finances';

    protected $fillable= [
        'name',
        'value',
        'type',
        'program',
        'note',
        'status',
        'proof_of_payment',
    ];

    public function program(){
        return $this->belongsTo(Program::class,'program','id');
    }
}
