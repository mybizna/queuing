<?php

$this->add_right("queuing", "attendant", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "attendant", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "attendant", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "attendant", "staff", view:true, add:true, edit:true);
$this->add_right("queuing", "attendant", "registered", view:true, add:true);
$this->add_right("queuing", "attendant", "guest", view:true, );

$this->add_right("queuing", "destination", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "destination", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "destination", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "destination", "staff", view:true, add:true, edit:true);
$this->add_right("queuing", "destination", "registered", view:true, add:true);
$this->add_right("queuing", "destination", "guest", view:true, );

$this->add_right("queuing", "ticket", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "ticket", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "ticket", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "ticket", "staff", view:true, add:true, edit:true);
$this->add_right("queuing", "ticket", "registered", view:true, add:true);
$this->add_right("queuing", "ticket", "guest", view:true, );

$this->add_right("queuing", "ticket_log", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "ticket_log", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "ticket_log", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("queuing", "ticket_log", "staff", view:true, add:true, edit:true);
$this->add_right("queuing", "ticket_log", "registered", view:true, add:true);
$this->add_right("queuing", "ticket_log", "guest", view:true, );
