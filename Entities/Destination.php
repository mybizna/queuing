<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
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

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $assigned = ['least', 'specific', 'random'];

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('name')->html('text');
        $this->fields->string('slug')->html('text');
        $this->fields->string('description')->html('textarea');
        $this->fields->enum('assigned', $assigned)->options($assigned)->default('least')->nullable()->html('select');
    }

 



}
