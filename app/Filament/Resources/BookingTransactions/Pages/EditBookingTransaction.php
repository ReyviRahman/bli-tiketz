<?php

namespace App\Filament\Resources\BookingTransactions\Pages;

use App\Filament\Resources\BookingTransactions\BookingTransactionResource;
use App\Models\WorkshopParticipant;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditBookingTransaction extends EditRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['participants'] = $this->record->participants->map(function ($participant) {
            return [
                'nama' => $participant->name,
                'occupation' => $participant->occupation,
                'email' => $participant->email,
            ];
        })->toArray();

        return $data;
    }

    protected function afterSave(): void {
        DB::transaction(function () {
            $record = $this->record;
            $record->participants()->delete();

            $participants = $this->form->getState()['participants'];

            foreach ($participants as $participant) {
                WorkshopParticipant::create([
                    'workshop_id' => $record->workshop_id,
                    'booking_transaction_id' => $record->id,
                    'name' => $participant['name'],
                    'occupation' => $participant['occupation'],
                    'email' => $participant['email'],
                ]);
            }
        });
    }
}
