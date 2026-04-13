<?php

namespace App\Filament\Widgets;

use App\Models\AiProvider;
use App\Models\Lead;
use App\Models\User;
use App\Filament\Resources\AiProviders\AiProviderResource;
use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Resources\UserResource;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Agentes IA', AiProvider::count())
                ->description('Configuración IA')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('primary')
                ->url(AiProviderResource::getUrl('index')),

            Stat::make('Usuarios', User::count())
                ->description('Usuarios en el sistema')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->url(UserResource::getUrl('index')),

            Stat::make('Leads Totales', Lead::count())
                ->description('Interesados registrados')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info')
                ->url(LeadResource::getUrl('index')),

            Stat::make('Leads Pendientes', Lead::where('status', 'pending')->count())
                ->description('Requieren atención')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url(LeadResource::getUrl('index')),

            Stat::make('Leads Contactados', Lead::where('status', 'contacted')->count())
                ->description('En proceso')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->url(LeadResource::getUrl('index')),

            Stat::make('Leads Archivados', Lead::where('status', 'archived')->count())
                ->description('Descartados o cerrados')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('gray')
                ->url(LeadResource::getUrl('index')),
        ];
    }
}
