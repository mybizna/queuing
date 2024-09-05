<?php

namespace Modules\Queuing\Models;

use Modules\Base\Models\BaseModel;
use Modules\Queuing\Models\Attendant;

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

    /**
     * Add relationship to Attendant
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendant()
    {
        return $this->belongsTo(Attendant::class);
    }

}
