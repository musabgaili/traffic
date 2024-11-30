<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ras extends Model
{
    //

    protected $guarded = ['id'];

    public function groups()
    {
        return $this->belongsToMany(RasGroup::class, 'ras_ras_group', 'ras_id', 'ras_group_id');
    }


    // php artisan make:migration create_ras_ras_group_table --create=ras_ras_group

}
