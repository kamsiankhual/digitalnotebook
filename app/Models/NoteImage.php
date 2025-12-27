<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteImage extends Model
{
    protected $table = 'note_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'image',
        'note_id'
    ];

    public function note() {
        return $this->belongsTo(Note::class);
    }
}
