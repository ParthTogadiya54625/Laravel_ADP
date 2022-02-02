<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id', 'latitude', 'longitude', 'user_id', 'name', 'company', 'email', 'phone', 'address', 'address2', 'city', 'state', 'zipcode', 'url', 'logo',
    ];

    /**
     * business belongs to one user (one to many(inverse) relationship)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * business associated with many headings
     */
    public function headings()
    {
        return $this->belongsToMany(Heading::class)->withPivot('image', 'offered_keywords', 'additional_keywords');
    }
}
