<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetConsultation extends Model
{
    use HasFactory;
    
    // Add phoneNumber to fillable properties
    protected $fillable = [
        'problemId',
        'phoneNumber',
        'iwill_pet_id',
        'phoneNumber',
        'modality',
        "description",
        "optIn",
        "videoSessionId",
        "openToKApiKey",
        "primaryPatientToken",
        "whenScheduled",
        "petConsultId",
        "created_at",
        "updated_at"
    ];
}
