<?php

namespace Modules\Queuing\Entities;

use Modules\Base\Entities\BaseModel;

class Ticket extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['number', 'prefix', 'attendant_id', 'is_closed'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_ticket";

}
