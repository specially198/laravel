<?php

namespace App\Models;

use App\Enums\BookCategoryType;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'author',
        'purchase_date',
        'evaluation',
        'status',
        'memo',
    ];

    protected $dates = ['purchase_date'];

    protected $attributes = [
        'status' => '1',
    ];

    public function categoryText(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => BookCategoryType::getDescription($this->category)
        );
    }

    public function displayPurchaseDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->purchase_date != null ? Carbon::parse($this->purchase_date)->format('Y年n月j日') : ''
        );
    }

    public function formatYmdPurchaseDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->purchase_date != null ? Carbon::parse($this->purchase_date)->format('Y-m-d') : ''
        );
    }
}
