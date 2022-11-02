<?php

namespace App\Models\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image\Image;
use App\Models\Lease\Lease;

class Property extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    protected $fillable = [
        'address',
        'status',
        'baths',
        'beds',
        'square',
        'price'
    ];
    
    protected $paginationLimit = 10;

    public const VALIDATION_RULES = [
        'address' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'baths' => 'required|integer|min:1|max:100',
        'beds' => 'required|integer|min:1|max:100',
        'square' => 'required|integer|min:1|max:10000',
        'price' => 'required|numeric|min:1|max:1000000'
    ];

    public const SORTABLE = [
        'id',
        'address',
        'status',
        'baths',
        'beds',
        'square',
        'price'
    ];
}
