<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'category', 'developer'];
    // protected $guarded =[]


    public function games()
    {
        return $this->belongsToMany(Game::class)->withTimestamps();
    }

}
