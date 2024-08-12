<?php

namespace Modules\Queuing\Filament\Resources\TicketLogResource\Pages;

use Modules\Queuing\Filament\Resources\TicketLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketLog extends EditRecord
{
    protected static string $resource = TicketLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
