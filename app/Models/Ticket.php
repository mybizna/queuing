<?php

namespace Modules\Queuing\Models;

use Modules\Base\Models\BaseModel;
use Modules\Queuing\Models\Attendant;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function attendant(): BelongsTo
    {
        return $this->belongsTo(Attendant::class);
    }

    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->string('number')->nullable();
        $table->string('prefix')->nullable();
        $table->foreignId('attendant_id')->nullable()->constrained(table: 'queuing_attendant')->onDelete('set null');
        $table->tinyInteger('is_announced')->nullable()->default(0);
        $table->tinyInteger('is_closed')->nullable()->default(0);

    }

}
