<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $label = 'Inventaris';
    protected static ?string $pluralLabel = 'Inventaris';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->native(false)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->maxLength(50_000)
                    ->required(),
                Forms\Components\Textarea::make('spesification')
                    ->rows(3)
                    ->maxLength(50_000)
                    ->required(),
                Forms\Components\Textarea::make('origin_of_acquisition')
                    ->rows(3)
                    ->maxLength(50_000)
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('building_id')
                    ->label('Gedung')
                    ->relationship(name: 'building', titleAttribute: 'name')
                    ->native(false)
                    ->suffixIcon('heroicon-o-building-office-2')
                    ->required()
                    ->afterStateUpdated(function (Forms\Set $set) {
                        $set('room_id', '');
                    })
                    ->live(),
                Forms\Components\Select::make('room_id')
                    ->label('Ruangan')
                    ->options(fn (Get $get): Collection => Room::query()
                        ->where('building_id', $get('building_id') ?? null)
                        ->pluck('name', 'id'))
                    ->native(false)
                    ->suffixIcon('heroicon-o-building-storefront')
                    ->required(),
                Forms\Components\TextInput::make('series_number')
                    ->label('Nomor Seri')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('brand')
                    ->label('Merek')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->label('Tipe')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('color')
                    ->label('Warna')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah Barang')
                    ->required()
                    ->minValue(0)
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('procurement_year')
                    ->label('Tahun Pengadaan')
                    ->options(fn () => range(date('Y')+3, 1990, -1))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->step(1)
                    ->minValue(0)
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\DatePicker::make('registration_date')
                    ->required(),
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Barang')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->hidden(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('building_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('series_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('procurement_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationItems(): array
    {
        return [
            parent::getNavigationItems()[0]
                ->isActiveWhen(fn () => request()->routeIs(static::getRouteBaseName() . '.*') && ! request()->routeIs(static::getRouteBaseName() . '.create')),
        ];
    }
}
