<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id', 
        'vet_id', 
        'date', 
        'notes', 
        'status'
        ];

    // Relacionamento: A consulta pertence a um paciente (pet)
    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    // Relacionamento: A consulta pertence a um cliente (user)
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento: A consulta pertence a um veterinário (user)
    public function vet() {
        return $this->belongsTo(User::class, 'vet_id');
    }
}