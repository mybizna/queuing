<?php

$this->add_module_info("queuing", [
    'title' => 'Queuing',
    'description' => 'Queuing',
    'icon' => 'fas fa-ticketing',
    'path' => '/queuing/admin/ticketing',
    'class_str' => 'text-primary border-primary',
    'position' => 1,
]);

$this->add_menu("queuing", "ticketing", "Ticketing", "/queuing/admin/ticketing", "fas fa-cogs", 1);
$this->add_menu("queuing", "ticketing_log", "Ticketing Log", "/queuing/admin/ticketing_log", "fas fa-cogs", 1);
$this->add_menu("queuing", "destination", "Destination", "/queuing/admin/destination", "fas fa-cogs", 1);
$this->add_menu("queuing", "attendant", "Attendant", "/queuing/admin/attendant", "fas fa-cogs", 1);