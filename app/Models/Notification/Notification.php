<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];

    protected $paginateLimit = 10;

    public const VALIDATION_RULES = [
        'title' => 'required|string|max:255',
        'body' => 'required|string|max:255'
    ];
}
