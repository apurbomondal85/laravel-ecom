<?php
namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "web" route file for the application.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapAdminRoutes();

            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace("App\Http\Controllers\Public")
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function mapAdminRoutes()
    {
        $host = parse_url(config('app.url'))['host'];
        $admin_prefix = config('app.admin_prefix');
        $domain = $admin_prefix . '.' . $host;

        Route::middleware('web')
            ->domain($domain)
            ->name('admin.')
            ->namespace("App\Http\Controllers\Admin")
            ->group(base_path('routes/admin.php'));
    }
}
