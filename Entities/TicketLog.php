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
        $table->integer('ticket_id');
        $table->integer('attendant_id');
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('queuing_ticket', 'ticket_id')) {
            $table->foreign('ticket_id')->references('id')->on('queuing_ticket')->nullOnDelete();
        }

        if (Migration::checkKeyExist('queuing_ticket', 'attendant_id')) {
            $table->foreign('attendant_id')->references('id')->on('queuing_attendant')->nullOnDelete();
        }
    }
}
