<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lease\Lease;

class Tenant extends Model
{
    use HasFactory;

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    protected $paginationLimit = 10;

    public const VALIDATION_RULES = [
        'first_name' => 'required|string|max:25',
        'last_name' => 'required|string|max:25',
        'email' => 'required|string|max:50',
        'phone' => 'required|string|max:20'
    ];

    public const SORTABLE = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone'
    ];
}
