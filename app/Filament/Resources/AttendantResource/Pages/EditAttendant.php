<?php

namespace Modules\Queuing\Filament\Resources\AttendantResource\Pages;

use Modules\Queuing\Filament\Resources\AttendantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttendant extends EditRecord
{
    protected static string $resource = AttendantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
