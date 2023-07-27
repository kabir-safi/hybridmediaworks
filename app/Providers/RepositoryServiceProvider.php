<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\MeetingInterface;
use App\Repositories\MeetingRepository;
use App\Interfaces\AttendeeInterface;
use App\Repositories\AttendeeRepository;
use App\Interfaces\CalendarInterface;
use App\Repositories\CalendarRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind Interface and Repository class together
        $this->app->bind(MeetingInterface::class, MeetingRepository::class);
        $this->app->bind(AttendeeInterface::class, AttendeeRepository::class);
        $this->app->bind(CalendarInterface::class, CalendarRepository::class);
        
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
