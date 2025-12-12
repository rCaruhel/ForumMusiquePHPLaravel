<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Publication extends Model
{
    /** @use HasFactory<\Database\Factories\PublicationFactory> */
    use HasFactory, Notifiable;



    public function user() { return $this->belongsTo(User::class, 'user_id'); }

    public function type_demande() { return $this->belongsTo(TypeDemande::class,'demande_id'); }

    public function commentaire(){return $this->hasMany(Commentaire::class)->orderBy('created_at','DESC');}
}
