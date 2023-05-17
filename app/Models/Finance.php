<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_type',
        'bus_type',
        'bus_des',
        'pname',
        'pnamec',
        'pgender',
        'pdob',
        'pnumber',
        'pexdate',
        'prenrem',
        'pcountry',
        'premtr',
        'ptinnumber',
        'ptincountry',
        'ptypetin',
        'pphoneno',
        'pemail',
        'paddress',
        'premarks',
        'companies',
        'shareholders',
        'financial',
        'payment_rep',
        'report_rep',
        'created_by'

    ];

    public function companies()
    {
        return $this->hasMany(Companie::class,'finance_id');
    }


}
