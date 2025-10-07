<?php

namespace App\Filament\Resources\WorkshopParticipants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorkshopParticipantForm
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

                TextInput::make('email')
                    ->required()
                    ->maxLength(255),

                Select::make('workshop_id')
                    ->relationship('workshop', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                
                Select::make('booking_transaction_id')
                    ->relationship('bookingTransaction', 'booking_trx_id')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
