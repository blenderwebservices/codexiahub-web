<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->columnSpanFull(),
                \Filament\Forms\Components\Select::make('status')
                    ->label('Estado')
                    ->options([
                        'pending'   => 'Pendiente',
                        'contacted' => 'Contactado',
                        'archived'  => 'Archivado',
                    ])
                    ->default('pending')
                    ->required(),
                TextInput::make('source')
                    ->label('Origen')
                    ->default('diagnostico_express')
                    ->required(),
                TextInput::make('ip_address')
                    ->label('Dirección IP')
                    ->disabled()
                    ->dehydrated(),
            ]);
    }
}
