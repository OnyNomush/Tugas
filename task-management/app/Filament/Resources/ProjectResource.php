<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn; // ✅ Benar
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nama Proyek')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi Proyek')
                ->required()
                ->maxLength(500),

            Forms\Components\DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required()
                ->default(now()),

            Forms\Components\DatePicker::make('end_date')
                ->label('Tanggal Selesai')
                ->required()
                ->default(now()->addMonth()),

            Forms\Components\Select::make('status')
                ->label('Status Proyek')
                ->options([
                    'not_started' => 'Belum Dimulai',
                    'in_progress' => 'Sedang Berlangsung',
                    'completed' => 'Selesai',
                ])
                ->required()
                ->default('not_started'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
TextColumn::make('tasks_count')->counts('tasks')->label('Jumlah Tugas'),

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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
