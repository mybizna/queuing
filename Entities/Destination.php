<?php

namespace Modules\Queuing\Entities;

use Modules\Base\Entities\BaseModel;

class Destination extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'description', 'assigned'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_destination";

}
