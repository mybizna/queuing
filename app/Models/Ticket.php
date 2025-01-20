<?php
namespace Modules\Queuing\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
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
    public function attendant(): BelongsTo
    {
        return $this->belongsTo(Attendant::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->string('number')->nullable();
        $table->string('prefix')->nullable();
        $table->unsignedBigInteger('attendant_id')->nullable();
        $table->tinyInteger('is_announced')->nullable()->default(0);
        $table->tinyInteger('is_closed')->nullable()->default(0);

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('attendant_id')->references('id')->on('queuing_attendant')->onDelete('set null');
    }

}
