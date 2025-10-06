<?php

namespace App\Filament\Resources\WorkshopParticipants\Pages;

use App\Filament\Resources\WorkshopParticipants\WorkshopParticipantResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkshopParticipants extends ListRecords
{
    protected static string $resource = WorkshopParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
