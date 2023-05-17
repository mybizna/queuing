<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Attendant extends BaseModel
{

    protected $fillable = ['name', 'slug', 'description', 'user_id', 'destination_id'];
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
        $table->string('slug');
        $table->string('description');
        $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
        $table->unsignedBigInteger('destination_id');
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('queuing_attendant', 'destination_id')) {
            $table->foreign('destination_id')->references('id')->on('queuing_destination')->nullOnDelete();
        }

        if (Migration::checkKeyExist('queuing_attendant', 'user_id')) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        }
    }
}
