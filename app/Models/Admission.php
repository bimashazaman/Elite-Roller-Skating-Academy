<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'sport_interest',
        'experience_level',
        'medical_conditions',
        'emergency_contact_name',
        'emergency_contact_phone',
        'preferred_training_time',
        'additional_notes',
        'document_uploads',
        'status'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
