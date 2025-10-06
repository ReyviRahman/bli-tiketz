<?php

namespace App\Filament\Resources\WorkshopInstructors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorkshopInstructorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                TextInput::make('occupation')
                ->required()
                ->maxLength(255),

                FileUpload::make('avatar')
                ->image()
                ->required()

            ]);
    }
}
