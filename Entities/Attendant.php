<?php

namespace Modules\Queuing\Models

use Modules\Base\ModelsaseModel;

class Attendant extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'description', 'partner_id', 'destination_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "queuing_attendant";

}
