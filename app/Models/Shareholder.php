<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shareholder extends Model
{
    use HasFactory;

    protected $fillable = [
        's_id',
        'fo_equity',
        'pname',
        'pnamec',
        'prenrem',
        'pdob',
        'pgender',
        'pnumber',
        'pexdate',
        'pcountry',
        'pemail',
        'pphoneno',
        'paddress',
        'ptincountry',
        'ptinnumber',
        'ptypetin',
        'jtitle',
        'msalary',
        'rl_with_sh',
        'premarks',
        'c_id',
    ];
}
