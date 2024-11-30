<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RasGroup extends Model
{
    //

    protected $guarded = ['id'];
    public function rases(): HasMany
    {
        return $this->hasMany(Ras::class,'group_id');
    }
}
