<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        RichEditor::make('content')
                            ->label('Content')
                            ->columnSpanFull(),
                    ]),

                Section::make('SEO')
                    ->description('Improve search engine visibility')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title'),

                        TextInput::make('meta_description')
                            ->label('Meta Description'),
                    ]),

                Section::make('Publishing')
                    ->schema([
                        Toggle::make('published')
                            ->default(true)
                            ->label('Published'),
                    ]),
            ]);
    }
}
