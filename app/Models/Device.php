<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Device extends Model
{
    /**
     * Using Trait Uuids to override primary key in Uuid format
     */
    use HasFactory, Uuids;

    // Make all feilds fillable
    protected $guarded = [];

    /**
     * The name of the "created at" column.
     *
     */
    const CREATED_AT = 'created_datetime';

    /**
     * The name of the "updated at" column.
     *
     */
    const UPDATED_AT = 'update_datetime';

}
