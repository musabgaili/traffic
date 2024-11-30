<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ras extends Model
{
    //

    protected $guarded = ['id'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(RasGroup::class);
    }
}
