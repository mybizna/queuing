<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Destination extends BaseModel
{

    protected $fillable = ['name', 'slug', 'description', 'assigned'];
    public $migrationDependancy = [];
    protected $table = "queuing_destination";

    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
        $table->string('slug');
        $table->string('description');
        $table->enum('assigned', ['least', 'specific', 'random'])->default('least')->nullable();
    }

}
