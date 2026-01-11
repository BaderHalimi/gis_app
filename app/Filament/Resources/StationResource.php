<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StationResource\Pages;
use App\Filament\Resources\StationResource\RelationManagers;
use App\Models\Station;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StationResource extends Resource
{
    protected static ?string $model = Station::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    
    protected static ?string $navigationLabel = 'المحطات';
    
    protected static ?string $modelLabel = 'محطة';
    
    protected static ?string $pluralModelLabel = 'المحطات';
    
    protected static ?string $navigationGroup = 'إدارة المحطات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات المحطة')
                    ->description('أدخل البيانات الأساسية للمحطة')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('اسم المحطة')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('مثال: محطة غاز المركزية'),
                        Forms\Components\Select::make('type')
                            ->label('نوع المحطة')
                            ->required()
                            ->options([
                                'gas' => '⛽ محطة غاز',
                                'petrol' => '🛢️ محطة بترول',
                                'fire' => '🚒 دفاع مدني',
                            ])
                            ->native(false),
                        Forms\Components\TextInput::make('address')
                            ->label('العنوان')
                            ->maxLength(255)
                            ->placeholder('مثال: شارع الرشيد، غزة'),
                        Forms\Components\Textarea::make('description')
                            ->label('الوصف')
                            ->rows(3)
                            ->placeholder('وصف مختصر عن المحطة')
                            ->columnSpanFull(),
                    ])->columns(2),
                    
                Forms\Components\Section::make('الموقع الجغرافي')
                    ->description('إحداثيات المحطة على الخريطة')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\TextInput::make('lat')
                            ->label('خط العرض (Latitude)')
                            ->required()
                            ->numeric()
                            ->step(0.000001)
                            ->placeholder('مثال: 31.5130'),
                        Forms\Components\TextInput::make('lng')
                            ->label('خط الطول (Longitude)')
                            ->required()
                            ->numeric()
                            ->step(0.000001)
                            ->placeholder('مثال: 34.4570'),
                    ])->columns(2),
                    
                Forms\Components\Section::make('معلومات إضافية')
                    ->description('الأسعار والصور')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Forms\Components\KeyValue::make('prices')
                            ->label('الأسعار')
                            ->keyLabel('الصنف')
                            ->valueLabel('السعر')
                            ->addActionLabel('إضافة سعر')
                            ->reorderable(),
                        Forms\Components\FileUpload::make('images')
                            ->label('صور المحطة')
                            ->multiple()
                            ->image()
                            ->directory('stations')
                            ->maxFiles(5)
                            ->reorderable()
                            ->columnSpanFull(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('النوع')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'gas' => '⛽ غاز',
                        'petrol' => '🛢️ بترول',
                        'fire' => '🚒 دفاع مدني',
                        default => $state,
                    })
                    ->colors([
                        'success' => 'gas',
                        'warning' => 'petrol',
                        'danger' => 'fire',
                    ]),
                Tables\Columns\TextColumn::make('address')
                    ->label('العنوان')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('lat')
                    ->label('خط العرض')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lng')
                    ->label('خط الطول')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع')
                    ->options([
                        'gas' => 'محطة غاز',
                        'petrol' => 'محطة بترول',
                        'fire' => 'دفاع مدني',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStations::route('/'),
            'create' => Pages\CreateStation::route('/create'),
            'edit' => Pages\EditStation::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
