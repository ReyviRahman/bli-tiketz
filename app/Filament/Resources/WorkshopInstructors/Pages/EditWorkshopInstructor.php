<?php

namespace App\Filament\Resources\WorkshopInstructors\Pages;

use App\Filament\Resources\WorkshopInstructors\WorkshopInstructorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditWorkshopInstructor extends EditRecord
{
    protected static string $resource = WorkshopInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
