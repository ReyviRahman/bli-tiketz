<?php

namespace App\Filament\Resources\BookingTransactions\Schemas;

use App\Models\Workshop;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class BookingTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product and Price')
                    ->schema([
                        Select::make('workshop_id')
                        ->relationship('workshop', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $workshop = Workshop::find($state);
                            $set('price', $workshop ? $workshop->price : 0);
                        })
                        ->afterStateHydrated(function ($state, callable $get, callable $set) {
                            $workshop = Workshop::find($state);
                            $set('price', $workshop ? $workshop->price : 0);
                        }),

                        TextInput::make('quantity')
                        ->required()
                        ->numeric()
                        ->prefix('Qty People')
                        ->live()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $price = $get('price');
                            $subTotal = $price * $state;
                            $totalPpn = $subTotal * 0.11;
                            $totalAmount = $subTotal + $totalPpn;

                            $set('total_amount', $totalAmount);

                            $participants = $get('participants') ?? [];
                            $currentCount = count($participants);

                            if ($state > $currentCount) {
                                for ($i = $currentCount; $i < $state; $i++) {
                                    $participants[] = ['name' => '', 'occupation' => '', 'email' => ''];
                                }
                            } else {
                                $participants = array_slice($participants, 0, $state);
                            }

                            $set('participants', $participants);
                        })
                        ->afterStateHydrated(function ($state, callable $get, callable $set) {
                            $price = $get('price');
                            $subTotal = $price * $state;
                            $totalPpn = $subTotal * 0.11;
                            $totalAmount = $subTotal + $totalPpn;

                            $set('total_amount', $totalAmount);
                        }),

                        TextInput::make('total_amount')
                        ->required()
                        ->numeric()
                        ->prefix('IDR')
                        ->readOnly()
                        ->helperText('Harga sudah include PPN 11%'),

                        Repeater::make('participants')
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                ->label('Participant Name')
                                ->required(),

                                TextInput::make('occupation')
                                ->label('Occupation')
                                ->required(),

                                TextInput::make('email')
                                ->label('Email')
                                ->required(),
                            ])  
                        ])
                        ->columns(1)
                        ->label('Participant Details')
                    ]),

                    Step::make('Customer Information')
                    ->schema([
                        TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('email')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('phone')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('customer_bank_name')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('customer_bank_account')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('customer_bank_number')
                        ->required()
                        ->maxLength(255),

                        TextInput::make('booking_trx_id')
                        ->required()
                        ->maxLength(255),
                    ]),

                    Step::make('Payment Information')
                    ->schema([
                        ToggleButtons::make('is_paid')
                        ->label('Apakah sudah membayar?')
                        ->boolean()
                        ->grouped()
                        ->icons([
                            true => 'heroicon-o-pencil',
                            false => 'heroicon-o-clock',
                        ])
                        ->required(),

                        FileUpload::make('proof')
                        ->image()
                        ->required()
                    ]),
                ])
                ->columnSpan('full')
                ->columns(1)
                ->skippable()
            ]);
    }
}
