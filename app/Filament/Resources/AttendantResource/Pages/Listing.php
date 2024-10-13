<?php

namespace Modules\Queuing\Filament\Resources\AttendantResource\Pages;

use Modules\Base\Filament\Resources\Pages\ListingBase;
use Modules\Queuing\Filament\Resources\AttendantResource;

// Class List that extends ListBase
class Listing extends ListingBase
{
    protected static string $resource = AttendantResource::class;
}
