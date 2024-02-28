<?php

namespace Modules\Queuing\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Destination extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'description', 'assigned'];

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
    public array $migrationDependancy = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_destination";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $assigned = ['least', 'specific', 'random'];

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('name')->html('text');
        $this->fields->string('slug')->html('text');
        $this->fields->string('description')->html('textarea');
        $this->fields->enum('assigned', $assigned)->options($assigned)->default('least')->nullable()->html('select');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['name', 'slug', 'assigned'];
        $structure['form'] = [
            ['label' => 'Name', 'class' => 'col-span-full', 'fields' => ['name', 'slug']],
            ['label' => 'Assigned', 'class' => 'col-span-full md:col-span-6ull md:col-span-6ull md:col-span-6ull md:col-span-6ull  md:col-span-6 md:pr-2', 'fields' => ['assigned']],
            ['label' => 'Description', 'class' => 'col-span-full', 'fields' => ['description']],
        ];
        $structure['filter'] = ['name', 'slug', 'assigned'];

        return $structure;
    }

}
