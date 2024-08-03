<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Ticket extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['number', 'prefix', 'attendant_id', 'is_closed'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_ticket";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('number')->html('text');
        $this->fields->string('prefix')->html('text');
        $this->fields->foreignId('attendant_id')->html('recordpicker')->relation(['queuing', 'attendant']);
        $this->fields->tinyInteger('is_announced')->nullable()->default(0)->html('switch');
        $this->fields->tinyInteger('is_closed')->nullable()->default(0)->html('switch');
    }


 

}
