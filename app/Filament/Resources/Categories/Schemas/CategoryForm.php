<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cateory Details')->schema([
                    Grid::make(2)->schema([
                        Select::make('parent_id')
                            ->label('Parent Category')
                            ->nullable()
                            ->relationship('parent','name')
                            ->preload()
                            ->searchable(),
                        Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive'
                            ])
                            ->default('active')
                            ->required()
                    ]),

                    TextInput::make('name')
                        ->required(),
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('categories')
                        ->nullable()
                ]),
            ]);
    }
}
