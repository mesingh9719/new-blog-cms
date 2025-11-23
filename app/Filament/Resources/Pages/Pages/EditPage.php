<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

     protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->record->load('blocks');

        $data['blocks'] = $this->record->blocks->map(function ($block) {
            return [
                'type' => $block->type,
                'data' => $block->data,
            ];
        })->toArray();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $blocks = $data['blocks'] ?? [];
        unset($data['blocks']);

        $record->update($data);

        $record->blocks()->delete();

        $position = 0;

        foreach ($blocks as $block) {
            $record->blocks()->create([
                'type' => $block['type'],
                'data' => $block['data'] ?? [],
                'position' => $position++,
            ]);
        }

        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
