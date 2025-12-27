<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(NoteImage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
