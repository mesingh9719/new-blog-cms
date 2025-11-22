<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Models\Setting;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    public function mount($record = null): void
    {
        $record = Setting::firstOrCreate([]);
        parent::mount($record->id);
    }

    public function getHeading(): string
    {
        return 'Site Settings';
    }

    public function getSubheading(): ?string
    {
        return 'Manage global configuration for your CMS';
    }

    public function getTitle(): string
    {
        return 'Site Settings';
    }

    
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

}
