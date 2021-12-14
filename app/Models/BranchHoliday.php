<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchHoliday extends Model
{
    use HasFactory;

    protected $table = "branch_holidays";

    protected $guarded = [];

    /**
     * Get the branch that owns the BranchHoliday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
