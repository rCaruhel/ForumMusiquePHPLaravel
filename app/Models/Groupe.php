<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Groupe extends Model
{
    /** @use HasFactory<\Database\Factories\GroupeFactory> */
    use HasFactory, Notifiable;
}
