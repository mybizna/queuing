<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Classes\Migration;

class Ticket extends BaseModel
{

    protected $fillable = ['number', 'attendant_id'];
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
        $table->integer('attendant_id');
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('queuing_ticket', 'attendant_id')) {
            $table->foreign('attendant_id')->references('id')->on('queuing_attendant')->nullOnDelete();
        }
    }
}
