<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'The Debrief';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                ->maxLength(255),

            Forms\Components\TextInput::make('slug')
                ->helperText('Auto-fills from the title — only change this if you know what you\'re doing, since it\'s the URL.')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Forms\Components\Select::make('tag')
                ->options([
                    'Opinion' => 'Opinion',
                    'Hot Take' => 'Hot Take',
                    'Process' => 'Process',
                    'Retrospective' => 'Retrospective',
                    'Behind The Scenes' => 'Behind The Scenes',
                ])
                ->required(),

            Forms\Components\Textarea::make('excerpt')
                ->label('Excerpt (shown on cards)')
                ->rows(2)
                ->maxLength(200)
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('featured_image')
                ->image()
                ->directory('blog')
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('body')
                ->required()
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_featured')
                ->label('Feature this post at the top of the blog index')
                ->default(false),

            Forms\Components\DateTimePicker::make('published_at')
                ->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tag')
                    ->badge(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('tag')
                    ->options([
                        'Opinion' => 'Opinion',
                        'Hot Take' => 'Hot Take',
                        'Process' => 'Process',
                        'Retrospective' => 'Retrospective',
                        'Behind The Scenes' => 'Behind The Scenes',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}