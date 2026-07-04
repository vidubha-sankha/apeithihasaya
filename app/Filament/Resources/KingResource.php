<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KingResource\Pages;
use App\Filament\Resources\KingResource\RelationManagers;
use App\Models\King;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KingResource extends Resource
{
    protected static ?string $model = King::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignorable: fn ($record) => $record)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255),
                        Forms\Components\Select::make('kingdom_id')
                            ->relationship('kingdom', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('dynasty_id')
                            ->relationship('dynasty', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Reign & Lineage')
                    ->schema([
                        Forms\Components\TextInput::make('father')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mother')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('spouse')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('birth_year')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('death_year')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('reign_start')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('reign_end')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('successor')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('predecessor')
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make('Biographical Details')
                    ->schema([
                        Forms\Components\Textarea::make('summary')
                            ->rows(3)
                            ->maxLength(1000),
                        Forms\Components\RichEditor::make('biography')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Media & Status')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('kings'),
                        Forms\Components\FileUpload::make('gallery')
                            ->multiple()
                            ->image()
                            ->directory('kings/galleries'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required(),
                        Forms\Components\Toggle::make('featured')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kingdom.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dynasty.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reign_start')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('reign_end')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kingdom_id')
                    ->relationship('kingdom', 'name')
                    ->label('Kingdom'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKings::route('/'),
            'create' => Pages\CreateKing::route('/create'),
            'edit' => Pages\EditKing::route('/{record}/edit'),
        ];
    }
}
