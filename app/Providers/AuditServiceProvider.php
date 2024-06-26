<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Observers\AuditObserver;

class AuditServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Model::observe(AuditObserver::class);
    }

    public function register()
    {
        //
    }
}

