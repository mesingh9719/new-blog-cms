<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $blocks = $data['blocks'] ?? [];
        unset($data['blocks']);

        /** @var Model $page */
        $page = static::getModel()::create($data);

        $position = 0;
        foreach ($blocks as $block) {
            $page->blocks()->create([
                'type' => $block['type'],
                'data' => $block['data'] ?? [],
                'position' => $position++,
            ]);
        }

        return $page;
    }
}
