<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
use Modules\Base\Entities\BaseModel;

class Attendant extends BaseModel
{
    /**
     * The fields that can be filled
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'description', 'user_id', 'destination_id'];

    /**
     * List of tables names that are need in this model during migration.
     * @var array<string>
     */
    public array $migrationDependancy = ['queuing_destination'];

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = "queuing_attendant";

    public function listTable(): ListTable
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('name')->type('text')->ordering(true);
        $fields->name('slug')->type('text')->ordering(true);
        $fields->name('user_id')->type('recordpicker')->table('users')->ordering(true);
        $fields->name('destination_id')->type('recordpicker')->table('queuing_destination')->ordering(true);

        return $fields;

    }

    public function formBuilder(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('name')->type('text')->group('w-1/2');
        $fields->name('slug')->type('text')->group('w-1/2');
        $fields->name('user_id')->type('recordpicker')->table('users')->group('w-1/2');
        $fields->name('destination_id')->type('recordpicker')->table('queuing_destination')->group('w-1/2');
        $fields->name('description')->type('textarea')->group('w-full');

        return $fields;

    }

    public function filter(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('name')->type('text')->group('w-1/6');
        $fields->name('slug')->type('text')->group('w-1/6');
        $fields->name('user_id')->type('recordpicker')->table('users')->group('w-1/6');
        $fields->name('destination_id')->type('recordpicker')->table('queuing_destination')->group('w-1/6');

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
        $table->string('name');
        $table->string('slug');
        $table->string('description');
        $table->foreignId('user_id')->nullable()->index('user_id');
        $table->foreignId('destination_id');
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'queuing_destination', 'destination_id');
        Migration::addForeign($table, 'users', 'user_id');
    }
}
