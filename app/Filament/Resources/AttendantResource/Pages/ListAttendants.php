<?php

namespace Modules\Queuing\Filament\Resources\AttendantResource\Pages;

use Modules\Queuing\Filament\Resources\AttendantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendants extends ListRecords
{
    protected static string $resource = AttendantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
