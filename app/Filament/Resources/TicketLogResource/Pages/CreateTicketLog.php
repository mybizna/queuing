<?php

namespace Modules\Queuing\Filament\Resources\TicketLogResource\Pages;

use Modules\Queuing\Filament\Resources\TicketLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketLog extends CreateRecord
{
    protected static string $resource = TicketLogResource::class;
}
