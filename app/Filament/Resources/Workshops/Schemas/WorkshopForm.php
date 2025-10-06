<?php

namespace App\Filament\Resources\Workshops\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class WorkshopForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                Textarea::make('address')
                ->rows(3)
                ->required()
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->image()
                ->required(),

                FileUpload::make('venue_thumbnail')
                ->image()
                ->required(),

                FileUpload::make('bg_map')
                ->image()
                ->required(),

                Repeater::make('benefits')
                ->relationship('benefits')
                ->schema([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                ]),

                Fieldset::make('Additional')
                ->schema([
                    Textarea::make('about')
                    ->required(),

                    TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),

                    Select::make('is_open')
                    ->options([
                        true => 'Open',
                        false => 'Not Available'
                    ])
                    ->required(),

                    Select::make('has_started')
                    ->options([
                        true => 'Started',
                        false => 'Not Started Yet'
                    ])
                    ->required(),

                    Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                    Select::make('workshop_instructor_id')
                    ->relationship('instructor', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                    DatePicker::make('started_at')
                    ->required(),

                    TimePicker::make('time_at')
                    ->required(),

                ])
                ->columnSpan('full')


            ]);
    }
}
