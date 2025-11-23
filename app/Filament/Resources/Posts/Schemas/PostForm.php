<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Grid::make()
                ->schema([

                    // ------------------------------
                    // LEFT SIDE (Main Content)
                    // ------------------------------
                    Grid::make(1)->schema([
                        Section::make('Post Details')->collapsible()->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(250),

                            Textarea::make('excerpt')
                                ->rows(3)
                                ->placeholder('Short summary of the article...')
                                ->maxLength(500)
                                ->nullable(),

                                RichEditor::make('content')
                                ->required()
                                ->columnSpanFull()
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'link',
                                    'h2',
                                    'h3',
                                    'blockquote',
                                    'bulletList',
                                    'orderedList',
                                    'codeBlock',
                                    'horizontalRule',
                                    'attachFiles'
                                ]),

                                 FileUpload::make('featured_image')
                                ->image()
                                ->disk('public')
                                ->directory('posts')
                                ->nullable()
                                ->imageEditor(),
                        ]),


                    ])->columnSpan(8),

                    // ------------------------------
                    // RIGHT SIDE (Meta / Options)
                    // ------------------------------
                    Grid::make(1)->schema([

                        Section::make('Publishing')->schema([
                            Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                    'scheduled' => 'Scheduled'
                                ])
                                ->default('draft')
                                ->required(),

                            DateTimePicker::make('published_at')
                                ->label('Publish At')
                                ->nullable()
                                ->visible(fn ($get) => $get('status') === 'scheduled'),
                        ]),

                        Section::make('Categories & Tags')->schema([

                            Select::make('categories')
                                ->relationship('categories', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->required(),

                            Select::make('tags')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload(),
                        ]),

                    ])->columnSpan(8),

                ]),

            // ------------------------------
            // SEO (Collapsible for cleaner UI)
            // ------------------------------
            Section::make('SEO')
                ->collapsible()
                ->schema([

                    TextInput::make('meta_title')
                        ->maxLength(255),

                    Textarea::make('meta_description')
                        ->rows(3),

                    TextInput::make('meta_keywords')
                        ->placeholder('keyword1, keyword2, keyword3'),
                ]),
        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = auth()->id();
    return $data;
}

}
