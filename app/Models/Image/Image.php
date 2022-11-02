<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property\Property;

class Image extends Model
{
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    protected $fillable = [
        'property_id',
        'name',
        'full_path'
    ];

    public const VALIDATION_RULES = [
        'file' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];
}
