<?php

namespace Modules\Queuing\Entities\Data;

use Modules\Base\Classes\Datasetter;

class Destination
{

    public $ordering = 1;

    public function data(Datasetter $datasetter)
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
