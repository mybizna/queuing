<?php
namespace Modules\Queuing\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Modules\Queuing\Models\Destination;

class Attendant extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'description', 'partner_id', 'destination_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_attendant";

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Add relationship to Destination
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->string('name')->nullable();
        $table->string('slug')->nullable();
        $table->text('description')->nullable();
        $table->unsignedBigInteger('partner_id')->nullable();
        $table->unsignedBigInteger('destination_id')->nullable();
    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('partner_id')->references('id')->on('partner_partner')->onDelete('set null');
        $table->foreign('destination_id')->references('id')->on('queuing_destination')->onDelete('set null');
    }
}
