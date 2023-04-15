<?php

namespace Modules\Queuing\Entities\Data;

use Modules\Base\Classes\Datasetter;
use Illuminate\Support\Facades\DB;

class Attendant
{

    public $ordering = 1;

    public function data(Datasetter $datasetter)
    {
        $destination_id = DB::table('queuing_destination')->where('slug', 'registration')->value('id');
        $datasetter->add_data('queuing', 'destination', 'slug', [
            "name" => "Registration Room 1",
            "slug" => "registration_room_1",
            "description" => "Registration Room 1",
            "destination_id" => $destination_id,
        ]);

        $destination_id = DB::table('queuing_destination')->where('slug', 'billing')->value('id');
        $datasetter->add_data('queuing', 'destination', 'slug', [
            "name" => "Billing Counter 1",
            "slug" => "billing_counter_1",
            "description" => "Billing Counter 1",
            "destination_id" => $destination_id,
        ]);

        $destination_id = DB::table('queuing_destination')->where('slug', 'consultation')->value('id');
        $datasetter->add_data('queuing', 'destination', 'slug', [
            "name" => "Consultation Room 1",
            "slug" => "consultation_room_1",
            "description" => "Consultation Room 1",
            "destination_id" => $destination_id,
        ]);

    }
}
