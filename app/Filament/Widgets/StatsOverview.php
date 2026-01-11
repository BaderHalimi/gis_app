<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use App\Models\Station;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي المحطات', Station::count())
                ->description('جميع المحطات المسجلة')
                ->descriptionIcon('heroicon-o-map-pin')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('محطات الغاز', Station::where('type', 'gas')->count())
                ->description('محطات تعبئة الغاز')
                ->descriptionIcon('heroicon-o-fire')
                ->color('success'),

            Stat::make('محطات البترول', Station::where('type', 'petrol')->count())
                ->description('محطات الوقود')
                ->descriptionIcon('heroicon-o-beaker')
                ->color('warning'),

            Stat::make('مراكز الدفاع المدني', Station::where('type', 'fire')->count())
                ->description('محطات الإطفاء')
                ->descriptionIcon('heroicon-o-fire')
                ->color('danger'),

            Stat::make('الرسائل الواردة', Message::count())
                ->description('رسائل التواصل')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('info'),

            Stat::make('المستخدمين', User::count())
                ->description('المستخدمين المسجلين')
                ->descriptionIcon('heroicon-o-users')
                ->color('gray'),
        ];
    }
}
