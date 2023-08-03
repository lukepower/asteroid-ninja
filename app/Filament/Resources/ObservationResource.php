<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObservationResource\Pages;
use App\Filament\Resources\ObservationResource\RelationManagers;
use App\Models\Observation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObservationResource extends Resource
{
    protected static ?string $model = Observation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main data')
                ->description('Add information about the observer and observing site.')
                ->schema([
                    Forms\Components\TextInput::make('mpc_obscode')
                    ->required()
                    ->maxLength(5),
                    Forms\Components\TextInput::make('observer_name')
                    ->required()
                    ->maxLength(60),
                    Forms\Components\TextInput::make('measurer_name')
                    ->required()
                    ->maxLength(60),

                    Forms\Components\TextInput::make('tel_data')
                    ->required()
                    ->maxLength(60),
                ])
                ->columns(2)
                ->collapsible(),

                Section::make('Object data')
                ->description('Add information about the object.')
                ->schema([
                    Forms\Components\TextInput::make('object_name')
                    ->maxLength(50),
                    DateTimePicker::make('obs_time')
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mpc_obscode'),
            Tables\Columns\TextColumn::make('observer_name'),
            Tables\Columns\TextColumn::make('object_name'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListObservations::route('/'),
            'create' => Pages\CreateObservation::route('/create'),
            'edit' => Pages\EditObservation::route('/{record}/edit'),
        ];
    }
}
