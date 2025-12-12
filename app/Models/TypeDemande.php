<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TypeDemande extends Model
{
    /** @use HasFactory<\Database\Factories\TypeDemandeFactory> */
    use HasFactory, Notifiable;
}
