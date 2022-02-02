<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    /**
     * keyword belongs to heading (one to many(INVERSE) relationship)
     */
    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }

     /**
     * keyword belongs to heading (one to many(INVERSE) relationship)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
