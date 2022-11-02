<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lease\Lease;

class Document extends Model
{
    use HasFactory;

    public function lease()
    {
        return $this->belongsTo(Lease::class);
    }

    protected $fillable = [
        'lease_id',
        'name',
        'original_name',
        'full_path'
    ];

    public const VALIDATION_RULES = [
        // 'lease_id' => 'required|integer',
            // 'name' => 'required|string|max:50',
            // 'original_name' => 'required|string|max:255',
            // 'full_path' => 'required|string|max:255'
        'file' => 'required|mimes:txt,pdf,csv,png,jpg|max:2048'
    ];
}
