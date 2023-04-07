<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function help_request()
    {
        return $this->belongsTo(HelpRequest::class);
    }
}
