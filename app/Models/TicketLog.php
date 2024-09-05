<?php

namespace Modules\Queuing\Models;

use Modules\Base\Models\BaseModel;
use Modules\Queuing\Models\Attendant;
use Modules\Queuing\Models\Ticket;

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

    /**
     * Add relationship to Ticket
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Add relationship to Attendant
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendant()
    {
        return $this->belongsTo(Attendant::class);
    }

}
