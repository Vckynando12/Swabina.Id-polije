<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SocialLink;
use Illuminate\Support\Facades\View;

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
        View::composer(['partial.footer', 'partial-eng.footer-eng'], function ($view) {
            try {
                $social = SocialLink::select('facebook', 'youtube', 'instagram')
                    ->firstOrCreate(['id' => 1]);
                $view->with('social', $social);
            } catch (\Exception $e) {
                // Fallback jika database error
                $view->with('social', new SocialLink());
            }
        });
    }
}
