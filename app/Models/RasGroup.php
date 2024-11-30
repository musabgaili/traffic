<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RasGroup extends Model
{
    //

    protected $guarded = ['id'];
    public function rases()
    {
        return $this->belongsToMany(Ras::class, 'ras_ras_group', 'ras_group_id', 'ras_id');
    }
}
