<?php

namespace Modules\Queuing\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

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


    public function migration(Blueprint $table): void
    {

        $table->string('name')->nullable();
        $table->string('slug')->nullable();
        $table->text('description')->nullable();
        $table->enum('assigned', ['least', 'specific', 'random'])->nullable();

    }
}
