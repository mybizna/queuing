<?php

/** @var \Modules\Base\Classes\Fetch\Menus $this */

$this->add_module_info("queuing", [
    'title' => 'Queuing',
    'description' => 'Queuing',
    'icon' => 'fas fa-ticket-alt',
    'path' => '/queuing/admin/ticket',
    'class_str' => 'text-primary border-primary',
    'position' => 1,
]);

$this->add_menu("queuing", "ticket", "Ticketing", "/queuing/admin/ticket", "fas fa-cogs", 1);
$this->add_menu("queuing", "ticket_log", "Ticketing Log", "/queuing/admin/ticket_log", "fas fa-cogs", 1);
$this->add_menu("queuing", "destination", "Destination", "/queuing/admin/destination", "fas fa-cogs", 1);
$this->add_menu("queuing", "attendant", "Attendant", "/queuing/admin/attendant", "fas fa-cogs", 1);