<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimelineResource\Pages;
use App\Filament\Resources\TimelineResource\RelationManagers;
use App\Models\Timeline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimelineResource extends Resource
{
    protected static ?string $model = Timeline::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Event Details')
                    ->schema([
                        Forms\Components\TextInput::make('event_title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('event_year')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('e.g. 161 BC or 1948 AD'),
                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Historical Connections')
                    ->schema([
                        Forms\Components\Select::make('kingdom_id')
                            ->relationship('kingdom', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('dynasty_id')
                            ->relationship('dynasty', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('king_id')
                            ->relationship('king', 'name')
                            ->searchable()
                            ->preload(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event_year')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kingdom.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('king.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kingdom_id')
                    ->relationship('kingdom', 'name')
                    ->label('Kingdom'),
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
            'index' => Pages\ManageTimelines::route('/'),
        ];
    }
}
