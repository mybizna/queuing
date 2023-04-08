<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Classes\Migration;

class Attendant extends BaseModel
{

    protected $fillable = ['name', 'description','destination_id'];
    public $migrationDependancy = ['queuing_destination'];
    protected $table = "queuing_attendant";

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
        $table->integer('destination_id');
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('queuing_attendant', 'destination_id')) {
            $table->foreign('destination_id')->references('id')->on('queuing_destination')->nullOnDelete();
        }
    }
}
