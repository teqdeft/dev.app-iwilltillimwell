<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultations extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'userId', 'consultationId', 'stateid', 'consultationTypeName', 'modalities', 'phoneNumber', 'videoConsultReadyTextNumber', 'sureScriptPharmacy_id', 'patientDescription', 'translate', 'roi', 'cheifComplaint', 'otherProblems', 'whenScheduled', 'timezoneOffset'
    ];
}
