<?php

namespace Modules\Queuing\Models\Data;

use Modules\Base\Classes\Datasetter;

class Destination
{
    /**
     * Set ordering of the Class to be migrated.
     *
     * @var int
     */
    public $ordering = 1;

    /**
     * Run the database seeds with system default records.
     *
     * @param Datasetter $datasetter
     *
     * @return void
     */
    public function data(Datasetter $datasetter): void
    {
        $datasetter->add_data('queuing', 'destination', 'slug', [
            "name" => "Registration",
            "slug" => "registration",
            "description" => "Registration",
            "assigned" => "least",
        ]);

        $datasetter->add_data('queuing', 'destination', 'slug', [
            "name" => "Billing",
            "slug" => "billing",
            "description" => "Billing",
            "assigned" => "least",
        ]);

        $datasetter->add_data('queuing', 'destination', 'slug', [
            "name" => "Consultation",
            "slug" => "consultation",
            "description" => "Consultation",
            "assigned" => "least",
        ]);

    }
}
