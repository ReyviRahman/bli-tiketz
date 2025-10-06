<?php

namespace App\Filament\Resources\WorkshopParticipants;

use App\Filament\Resources\WorkshopParticipants\Pages\CreateWorkshopParticipant;
use App\Filament\Resources\WorkshopParticipants\Pages\EditWorkshopParticipant;
use App\Filament\Resources\WorkshopParticipants\Pages\ListWorkshopParticipants;
use App\Filament\Resources\WorkshopParticipants\Schemas\WorkshopParticipantForm;
use App\Filament\Resources\WorkshopParticipants\Tables\WorkshopParticipantsTable;
use App\Models\WorkshopParticipant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkshopParticipantResource extends Resource
{
    protected static ?string $model = WorkshopParticipant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WorkshopParticipantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkshopParticipantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkshopParticipants::route('/'),
            'create' => CreateWorkshopParticipant::route('/create'),
            'edit' => EditWorkshopParticipant::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
