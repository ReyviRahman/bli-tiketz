<?php

namespace App\Filament\Resources\WorkshopInstructors;

use App\Filament\Resources\WorkshopInstructors\Pages\CreateWorkshopInstructor;
use App\Filament\Resources\WorkshopInstructors\Pages\EditWorkshopInstructor;
use App\Filament\Resources\WorkshopInstructors\Pages\ListWorkshopInstructors;
use App\Filament\Resources\WorkshopInstructors\Schemas\WorkshopInstructorForm;
use App\Filament\Resources\WorkshopInstructors\Tables\WorkshopInstructorsTable;
use App\Models\WorkshopInstructor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkshopInstructorResource extends Resource
{
    protected static ?string $model = WorkshopInstructor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WorkshopInstructorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkshopInstructorsTable::configure($table);
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
            'index' => ListWorkshopInstructors::route('/'),
            'create' => CreateWorkshopInstructor::route('/create'),
            'edit' => EditWorkshopInstructor::route('/{record}/edit'),
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
