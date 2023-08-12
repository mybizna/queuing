<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
use Modules\Base\Entities\BaseModel;

class TicketLog extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['ticket_id', 'attendant_id'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['ticket_id', 'attendant_id'];

 

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['queuing_ticket', 'queuing_attendant'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_ticket_log";

    /**
     * Function for defining list of fields in table view.
     *
     * @return ListTable
     */
    public function listTable(): ListTable
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('ticket_id')->type('recordpicker')->table(['queuing', 'ticket'])->ordering(true);
        $fields->name('attendant_id')->type('recordpicker')->table(['queuing', 'attendant'])->ordering(true);

        return $fields;

    }

    /**
     * Function for defining list of fields in form view.
     * 
     * @return FormBuilder
     */
    public function formBuilder(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('ticket_id')->type('recordpicker')->table(['queuing', 'ticket'])->group('w-1/2');
        $fields->name('attendant_id')->type('recordpicker')->table(['queuing', 'attendant'])->group('w-1/2');

        return $fields;

    }

    /**
     * Function for defining list of fields in filter view.
     * 
     * @return FormBuilder
     */
    public function filter(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('ticket_id')->type('recordpicker')->table(['queuing', 'ticket'])->group('w-1/6');
        $fields->name('attendant_id')->type('recordpicker')->table(['queuing', 'attendant'])->group('w-1/6');

        return $fields;

    }
    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table): void
    {
        $table->increments('id');
        $table->foreignId('ticket_id');
        $table->foreignId('attendant_id');
    }

    /**
     * Handle post migration processes for adding foreign keys.
     *
     * @param Blueprint $table
     *
     * @return void
     */
    public function post_migration(Blueprint $table): void
    {
        Migration::addForeign($table, 'queuing_ticket', 'ticket_id');
        Migration::addForeign($table, 'queuing_attendant', 'attendant_id');
    }
}
