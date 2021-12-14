<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchLoanRestriction extends Model
{
    use HasFactory;

    protected $table = "branch_loan_restrictions";

    protected $guarded = [];

    /**
     * Get the branch that owns the BranchLoanRestriction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
