<?php

namespace App\Providers;

use App\Models\ChMessage;
use App\Models\shipping_info;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
        if (auth()->check()) {
            $user = auth()->user();
            $new_messages = ChMessage::where('to_id', $user->id)
                ->where('seen', false)
                ->get();
    
            View::share('new_messages', $new_messages);
        }
        
    
        $shippingOrders_today = shipping_info::whereDate('created_at', Carbon::today())
            ->where('order_type', 0)
            ->paginate(5);
    
        View::share('shippingOrders_today', $shippingOrders_today);
    
        Paginator::useBootstrap();
    }
    
}
