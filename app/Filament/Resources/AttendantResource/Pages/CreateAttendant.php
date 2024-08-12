<?php

namespace Modules\Queuing\Filament\Resources\AttendantResource\Pages;

use Modules\Queuing\Filament\Resources\AttendantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendant extends CreateRecord
{
    protected static string $resource = AttendantResource::class;
}
