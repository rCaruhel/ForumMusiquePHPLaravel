<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Commentaire extends Model
{
    /** @use HasFactory<\Database\Factories\CommentaireFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'comment',
        'user_id',
        'publication_id',
    ];

    public function user(){return $this->belongsTo(User::class);}
}
