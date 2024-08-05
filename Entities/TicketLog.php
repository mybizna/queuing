<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class TicketLog extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['ticket_id', 'attendant_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_ticket_log";

 



}
