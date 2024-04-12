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
    protected $fillable = ['name', 'slug', 'description', 'partner_id', 'destination_id'];

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

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('name')->html('text');
        $this->fields->string('slug')->html('text');
        $this->fields->string('description')->html('textarea');
        $this->fields->foreignId('partner_id')->nullable()->index('partner_id')->html('recordpicker')->relation(['users']);
        $this->fields->foreignId('destination_id')->html('recordpicker')->relation(['queuing', 'destination']);
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {

        $structure['table'] = ['name', 'slug', 'partner_id', 'destination_id'];
        $structure['form'] = [
            ['label' => 'Attendant Name', 'class' => 'col-span-full', 'fields' => ['name', 'slug']],
            ['label' => 'Attendant Detail', 'class' => 'col-span-full  md:col-span-6 md:pr-2', 'fields' => ['partner_id', 'destination_id']],
            ['label' => 'Attendant Other Setting', 'class' => 'col-span-full', 'fields' => ['description']],
        ];
        $structure['filter'] = ['name', 'slug', 'partner_id', 'destination_id'];

        return $structure;
    }


    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {

    }

}
