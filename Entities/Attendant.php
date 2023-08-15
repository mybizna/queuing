<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Attendant extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'description', 'user_id', 'destination_id'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['name'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['queuing_destination'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_attendant";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);
        
        $this->fields->increments('id')->html('text');
        $this->fields->string('name')->html('text');
        $this->fields->string('slug')->html('text');
        $this->fields->string('description')->html('textarea');
        $this->fields->foreignId('user_id')->nullable()->index('user_id')->html('recordpicker')->table(['users']);
        $this->fields->foreignId('destination_id')->html('recordpicker')->table(['queuing', 'destination']);
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure = [
            'table' => ['name', 'slug', 'user_id', 'destination_id'],
            'filter' => ['name', 'slug', 'user_id', 'destination_id'],
        ];

        return $structure;
    }

}
