<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
use Modules\Base\Entities\BaseModel;

class Ticket extends BaseModel
{
    /**
     * The fields that can be filled
     * @var array<string>
     */
    protected $fillable = ['number', 'prefix', 'attendant_id', 'is_closed'];

    /**
     * List of tables names that are need in this model during migration.
     * @var array<string>
     */
    public array $migrationDependancy = ['queuing_attendant'];

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = "queuing_ticket";

    public function listTable(): ListTable
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('number')->type('text')->ordering(true);
        $fields->name('prefix')->type('text')->ordering(true);
        $fields->name('attendant_id')->type('recordpicker')->table('queuing_attendant')->ordering(true);
        $fields->name('is_closed')->type('switch')->ordering(true);

        return $fields;

    }

    public function formBuilder()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('number')->type('text')->group('w-1/2');
        $fields->name('prefix')->type('text')->group('w-1/2');
        $fields->name('attendant_id')->type('recordpicker')->table('queuing_attendant')->group('w-1/2');
        $fields->name('is_closed')->type('switch')->group('w-1/2');

        return $fields;

    }

    public function filter(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('number')->type('text')->group('w-1/6');
        $fields->name('prefix')->type('text')->group('w-1/6');
        $fields->name('attendant_id')->type('recordpicker')->table('queuing_attendant')->group('w-1/6');
        $fields->name('is_closed')->type('switch')->group('w-1/6');

        return $fields;

    }
    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
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
