<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'isbn',
        'description',
    ];

    /**
     * Get the author that owns the book.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the category that owns the book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the ratings for the book.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get average rating for the book
     */
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    /**
     * Get voter count for the book
     */
    public function voterCount()
    {
        return $this->ratings()->count();
    }
}