<?php

namespace App\Filament\Resources\WorkshopParticipants\Pages;

use App\Filament\Resources\WorkshopParticipants\WorkshopParticipantResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditWorkshopParticipant extends EditRecord
{
    protected static string $resource = WorkshopParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
