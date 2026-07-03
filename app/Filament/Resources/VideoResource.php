<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-play-circle';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('youtube_id')
                ->label('YouTube Video ID')
                ->helperText('The part after "v=" in the YouTube URL — e.g. dQw4w9WgXcQ')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('category')
                ->options([
                    'Blind Retrospective' => 'Blind Retrospective',
                    'Honest Review' => 'Honest Review',
                    'First Reaction' => 'First Reaction',
                ])
                ->required(),

            Forms\Components\TextInput::make('duration')
                ->label('Duration (display only)')
                ->placeholder('28:14')
                ->maxLength(20),

            Forms\Components\Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_short')
                ->label('This is a Short (not a full video)')
                ->default(false),

            Forms\Components\DateTimePicker::make('published_at')
                ->label('Publish Date')
                ->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_url')
                    ->label('')
                    ->state(fn (Video $record) => $record->thumbnail_url)
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->badge(),

                Tables\Columns\IconColumn::make('is_short')
                    ->label('Short')
                    ->boolean(),

                Tables\Columns\TextColumn::make('duration'),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Blind Retrospective' => 'Blind Retrospective',
                        'Honest Review' => 'Honest Review',
                        'First Reaction' => 'First Reaction',
                    ]),
                Tables\Filters\TernaryFilter::make('is_short')
                    ->label('Shorts only'),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}