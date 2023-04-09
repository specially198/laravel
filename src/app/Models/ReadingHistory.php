<?php

namespace App\Models;

use Illuminate\Support\Carbon;
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

    protected $dates = ['finished_date'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function displayFinishedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->finished_date != null ? Carbon::parse($this->finished_date)->format('Y年n月j日') : ''
        );
    }

    public function formatYmdFinishedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->finished_date != null ? Carbon::parse($this->finished_date)->format('Y-m-d') : ''
        );
    }
}
