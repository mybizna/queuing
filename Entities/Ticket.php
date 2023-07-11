<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Ticket extends BaseModel
{

    protected $fillable = ['number', 'prefix', 'attendant_id', 'is_closed'];
    public $migrationDependancy = ['queuing_attendant'];
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
        $table->string('number');
        $table->string('prefix');
        $table->foreignId('attendant_id');
        $table->tinyInteger('is_announced')->nullable()->default(0);
        $table->tinyInteger('is_closed')->nullable()->default(0);
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'queuing_attendant', 'attendant_id');
    }
}
