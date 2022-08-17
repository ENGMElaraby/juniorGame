<?php

namespace App\Providers;

use App\Models\EducationSemester;
use App\Models\GameLevel;
use App\Models\HomeworkQuestion;
use App\Models\Level;
use App\Models\OfflineExam;
use App\Models\SemesterExams;
use App\Models\SemesterUnit;
use App\Models\SemesterVideo;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    public const DASHBOARD = '/admin/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string
     */
    protected string $apiNamespace = 'App\\Http\\Controllers\\API';

    protected string $adminNamespace = 'App\\Http\\Controllers\\Admin';

    protected string $userNamespace = 'App\\Http\\Controllers\\USER';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();


        $this->routes(function () {

            $this->apiRoutes();

            $this->webRoutes();

            $this->adminRoutes();

            $this->userRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Define api Routes
     */
    private function apiRoutes(): void
    {
        Route::prefix('api')
            ->name('api.')
            ->middleware('api')
            ->namespace($this->apiNamespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define api Routes
     */
    private function webRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define admin Routes
     */
    private function adminRoutes(): void
    {
        Route::prefix('admin')
            ->name('admin.')
            ->middleware('web')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define api Routes
     */
    private function userRoutes(): void
    {
        Route::name('user.')
            ->middleware('web')
            ->namespace($this->userNamespace)
            ->group(base_path('routes/user.php'));
    }
}
