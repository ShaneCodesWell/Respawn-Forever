<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                ->maxLength(255),

            Forms\Components\TextInput::make('slug')
                ->helperText('Auto-fills from the name — this becomes part of the product URL.')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Forms\Components\Select::make('category')
                ->options([
                    'digital' => 'Digital',
                    'merch' => 'Merch',
                ])
                ->required()
                ->live(), // needed so the digital_file field below can react to this

            Forms\Components\Select::make('badge')
                ->label('Badge (optional)')
                ->options([
                    'Bestseller' => 'Bestseller',
                    'New' => 'New',
                ])
                ->nullable(),

            Forms\Components\TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('$')
                ->maxValue(9999.99),

            Forms\Components\Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('products')
                ->columnSpanFull(),

            // Only show this field at all when the product is digital — no reason to
            // upload a downloadable file for a t-shirt.
            Forms\Components\FileUpload::make('digital_file')
                ->label('Downloadable File')
                ->directory('digital-products')
                ->visible(fn (callable $get) => $get('category') === 'digital')
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_active')
                ->label('Visible in shop')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state) => $state === 'digital' ? 'info' : 'danger'),

                Tables\Columns\TextColumn::make('price')
                    ->money('usd'),

                Tables\Columns\TextColumn::make('badge'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'digital' => 'Digital',
                        'merch' => 'Merch',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active only'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}