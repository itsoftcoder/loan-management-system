<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAddress extends Model
{
    use HasFactory;


    protected $table = "branch_addresses";

    protected $guarded = [];

    /**
     * Get the branch that owns the BranchAddress
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
