<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Ticket extends BaseModel
{

    protected $fillable = ['name', 'description', 'assigned'];
    public $migrationDependancy = [];
    protected $table = "queuing_ticket";

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
        $table->string('description');
        $table->enum('assigned', ['least', 'specific', 'random'])->default('least')->nullable();
    }

}
