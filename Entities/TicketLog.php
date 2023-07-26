<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;
use Modules\Core\Classes\Views\FormBuilder;
use Modules\Core\Classes\Views\ListTable;

class TicketLog extends BaseModel
{

    protected $fillable = ['ticket_id', 'attendant_id'];
    public $migrationDependancy = ['queuing_ticket', 'queuing_attendant'];
    protected $table = "queuing_ticket_log";

    public function listTable()
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('ticket_id')->type('recordpicker')->table('queuing_ticket')->ordering(true);
        $fields->name('attendant_id')->type('recordpicker')->table('queuing_attendant')->ordering(true);

        return $fields;

    }

    public function formBuilder()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('ticket_id')->type('recordpicker')->table('queuing_ticket')->group('w-1/2');
        $fields->name('attendant_id')->type('recordpicker')->table('queuing_attendant')->group('w-1/2');

        return $fields;

    }

    public function filter()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('ticket_id')->type('recordpicker')->table('queuing_ticket')->group('w-1/6');
        $fields->name('attendant_id')->type('recordpicker')->table('queuing_attendant')->group('w-1/6');

        return $fields;

    }
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
