<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agence extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_a',
        'numero_a',
        'email_a',
        'commune_a',
        'ville_a',
        'province_a',
        'solde_cdf',
        'solde_usd',
    ];
}
