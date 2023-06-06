<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Classes\Migration;

class TicketLog extends BaseModel
{

    protected $fillable = ['ticket_id', 'attendant_id'];
    public $migrationDependancy = ['queuing_ticket', 'queuing_attendant'];
    protected $table = "queuing_ticket_log";

    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->foreignId('ticket_id');
        $table->foreignId('attendant_id');
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'queuing_ticket', 'ticket_id');
        Migration::addForeign($table, 'queuing_attendant', 'attendant_id');
    }
}
