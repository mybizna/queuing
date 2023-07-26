<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;
use Modules\Core\Classes\Views\FormBuilder;
use Modules\Core\Classes\Views\ListTable;

class Ticket extends BaseModel
{

    protected $fillable = ['number', 'prefix', 'attendant_id', 'is_closed'];
    public $migrationDependancy = ['queuing_attendant'];
    protected $table = "queuing_ticket";

    public function listTable()
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

    public function filter()
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
