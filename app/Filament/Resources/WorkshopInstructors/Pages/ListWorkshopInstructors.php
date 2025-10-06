<?php

namespace App\Filament\Resources\WorkshopInstructors\Pages;

use App\Filament\Resources\WorkshopInstructors\WorkshopInstructorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkshopInstructors extends ListRecords
{
    protected static string $resource = WorkshopInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
