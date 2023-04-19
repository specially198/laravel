<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReadingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'finished_date',
        'evaluation',
        'thoughts',
    ];

    protected $casts = [
        'finished_date' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function displayFinishedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->finished_date != null ? $this->finished_date->format('Y年n月j日') : ''
        );
    }

    public function formatYmdFinishedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->finished_date != null ? $this->finished_date->format('Y-m-d') : ''
        );
    }
}
