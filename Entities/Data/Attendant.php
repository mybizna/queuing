<?php

namespace Modules\Queuing\Entities\Data;

use Illuminate\Support\Facades\DB;
use Modules\Base\Classes\Datasetter;

class Attendant
{
    /**
     * Set ordering of the Class to be migrated.
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
        $destination_id = DB::table('queuing_destination')->where('slug', 'registration')->value('id');
        $datasetter->add_data('queuing', 'attendant', 'slug', [
            "name" => "Registration Room 1",
            "slug" => "registration_room_1",
            "description" => "Registration Room 1",
            "destination_id" => $destination_id,
        ]);

        $destination_id = DB::table('queuing_destination')->where('slug', 'billing')->value('id');
        $datasetter->add_data('queuing', 'attendant', 'slug', [
            "name" => "Billing Counter 1",
            "slug" => "billing_counter_1",
            "description" => "Billing Counter 1",
            "destination_id" => $destination_id,
        ]);

        $destination_id = DB::table('queuing_destination')->where('slug', 'consultation')->value('id');
        $datasetter->add_data('queuing', 'attendant', 'slug', [
            "name" => "Consultation Room 1",
            "slug" => "consultation_room_1",
            "description" => "Consultation Room 1",
            "destination_id" => $destination_id,
        ]);

    }
}
