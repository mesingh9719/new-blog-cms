<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Branding')
                    ->description('Logos and visual identity')
                    ->schema([
                        Grid::make(3)->schema([
                            FileUpload::make('logo')
                                ->label('Logo (Light)')
                                ->disk('public')
                                ->directory('settings')
                                ->image()
                                ->imageEditor(),

                            FileUpload::make('logo_dark')
                                ->label('Logo (Dark)')
                                ->disk('public')
                                ->directory('settings')
                                ->image()
                                ->imageEditor(),

                            FileUpload::make('favicon')
                                ->label('Favicon')
                                ->disk('public')
                                ->directory('settings')
                                ->image(),
                        ]),
                    ])
                    ->collapsible(),

                Section::make('General')
                    ->description('Site information and core settings')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->required(),

                        TextInput::make('site_tagline')
                            ->label('Tagline')
                            ->placeholder('Short description of the website'),

                        TextInput::make('posts_per_page')
                            ->label('Posts Per Page')
                            ->numeric()
                            ->default(10),

                        Toggle::make('rss_enabled')
                            ->label('Enable RSS Feed')
                            ->default(true),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('SEO')
                    ->description('Global metadata for search engines')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Default Meta Title'),

                        Textarea::make('meta_description')
                            ->label('Default Meta Description')
                            ->rows(3),

                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords (comma separated)')
                            ->placeholder('news, articles, blog'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Social Links')
                    ->schema([
                        TextInput::make('facebook_url')->label('Facebook URL'),
                        TextInput::make('twitter_url')->label('Twitter / X URL'),
                        TextInput::make('instagram_url')->label('Instagram URL'),
                        TextInput::make('linkedin_url')->label('LinkedIn URL'),
                        TextInput::make('youtube_url')->label('YouTube URL'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Footer')
                    ->schema([
                        Textarea::make('footer_text')
                            ->label('Footer Text')
                            ->rows(2),

                        TextInput::make('copyright_text')
                            ->label('Copyright Text')
                            ->default('© ' . date('Y') . ' ' . config('app.name')),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
