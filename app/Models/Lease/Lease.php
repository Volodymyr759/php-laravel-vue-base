<?php

namespace App\Models\Lease;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document\Document;
use App\Models\Property\Property;
use App\Models\Tenant\Tenant;

class Lease extends Model
{
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    protected $fillable = [
        'property_id',
        'tenant_id',
        'status',
        'start_date',
        'end_date'
    ];
    
    protected $paginationLimit = 10;

    public const VALIDATION_RULES = [
        'property_id' => 'required|integer',
        'tenant_id' => 'required|integer',
        'status' => 'required|string|max:20',
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    public const SORTABLE = [
        'id',
        'start_date',
        'end_date'
    ];
}
