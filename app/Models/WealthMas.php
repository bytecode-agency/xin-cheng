<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthMas extends Model
{
    use HasFactory;
    protected $fillable = [
        'wealth_id',
        'account_status',
        'tax_advisor_name',
        'tax_advisor_email',
        'tax_advisor_no',
        'kickstart_tax_advisor',
        'deck_submission',
        'presentation_deck',
        'masnet_account',
        'preliminary_approval',
        'final_approval',
        'final_submission',
        'oic_name',
        'masnet_username',
        'masnet_password',
        'institution_code',
        'declaration_frequency',
        'commencement_date',
        'reminder_notification',
        'annual_declaration_deadline',
        'internal_account_manager',
        'trigger_fqy_rem',
        'remarks',        

    ];
}
