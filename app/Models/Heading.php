<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    use HasFactory;

    /**
     * heading has many keywords (one to many relationship)
     */
    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }

    /**
     * keywords associated with many business
     */
    public function businesses()
    {
        return $this->belongsToMany(Business::class)->withPivot('image', 'offered_keywords', 'additional_keywords');
    }
}
