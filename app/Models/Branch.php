<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = "branches";

    protected $guarded = [];

    /**
     * Get all of the capitals for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function capitals()
    {
        return $this->hasMany(BranchCapital::class);
    }


    /**
     * Get the setting associated with the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function setting()
    {
        return $this->hasOne(BranchSetting::class);
    }


    /**
     * Get the address associated with the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne(BranchAddress::class);
    }


    /**
     * Get the loanRestriction associated with the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function loanRestriction()
    {
        return $this->hasOne(BranchLoanRestriction::class);
    }

    /**
     * Get all of the holidays for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function holidays()
    {
        return $this->hasMany(BranchHoliday::class);
    }

    /**
     * The accessUsers that belong to the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accessUsers()
    {
        return $this->belongsToMany(User::class, 'access_user', 'user_id', 'branch_id');
    }
}
