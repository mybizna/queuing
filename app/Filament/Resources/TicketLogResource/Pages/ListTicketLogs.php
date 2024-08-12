<?php

namespace Modules\Queuing\Filament\Resources\TicketLogResource\Pages;

use Modules\Queuing\Filament\Resources\TicketLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketLogs extends ListRecords
{
    protected static string $resource = TicketLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
