<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([])
            ->paginated(false)
            ->emptyStateHeading('Settings are managed through a single configuration.')
            ->emptyStateDescription('Click the Edit button above to modify settings.');
    }
}
