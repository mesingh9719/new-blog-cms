<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Tabs;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs as ComponentsTabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsTabs::make('Page Builder')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Section::make('Page Info')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),

                                        TextInput::make('slug')
                                            ->required()
                                            ->unique(ignoreRecord: true),
                                    ])
                                    ->columns(2),

                                Toggle::make('settings.show_in_menu')
                                    ->label('Show in Navigation')
                                    ->default(true),
                            ]),

                        Tab::make('Content Blocks')
                            ->schema([
                                Builder::make('blocks')
                                    ->label('Page Sections')
                                    ->blocks([
                                        Builder\Block::make('hero')
                                            ->label('Hero Section')
                                            ->schema([
                                                TextInput::make('title')->required(),
                                                TextInput::make('subtitle'),
                                                FileUpload::make('background')->disk('public')->directory('hero-section')->image(),
                                                TextInput::make('button_text'),
                                                TextInput::make('button_url'),
                                            ])
                                            ->columns(2),

                                        Builder\Block::make('heading')
                                            ->label('Heading')
                                            ->schema([
                                                TextInput::make('text')->required(),
                                                Select::make('size')
                                                    ->options([
                                                        'h1' => 'Large',
                                                        'h2' => 'Medium',
                                                        'h3' => 'Small',
                                                    ])
                                                    ->default('h2'),
                                            ])
                                            ->columns(2),

                                        Builder\Block::make('text')
                                            ->label('Text')
                                            ->schema([
                                                RichEditor::make('html')->required(),
                                            ]),

                                        Builder\Block::make('image_text')
                                            ->label('Image + Text')
                                            ->schema([
                                                FileUpload::make('image')->image()->disk('public')->directory('page-image-text')->required(),
                                                RichEditor::make('text')->required(),
                                                Toggle::make('reverse')->label('Swap Layout'),
                                            ])
                                            ->columns(2),

                                        Builder\Block::make('cta')
                                            ->label('Call To Action')
                                            ->schema([
                                                TextInput::make('title')->required(),
                                                TextInput::make('button_text'),
                                                TextInput::make('button_url'),
                                            ])
                                            ->columns(2),
                                    ])
                                    ->collapsible()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Design')
                            ->schema([
                                Section::make('Styling')
                                    ->schema([
                                        Toggle::make('settings.display_title')
                                            ->default(true)
                                            ->label('Display Title'),

                                        Select::make('settings.layout')
                                            ->label('Page Layout')
                                            ->options([
                                                'full' => 'Full Width',
                                                'boxed' => 'Boxed',
                                            ])
                                            ->default('full'),

                                        ColorPicker::make('settings.background_color')
                                            ->default('#ffffff')
                                            ->label('Background Color'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tab::make('Publishing')
                            ->schema([
                                Toggle::make('published')
                                    ->default(true)
                                    ->label('Published'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
