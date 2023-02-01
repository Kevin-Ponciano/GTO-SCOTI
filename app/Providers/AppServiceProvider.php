<?php

namespace App\Providers;

use App\Http\Livewire\Tasks;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('search', function ($field, $string){
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });
        Schema::defaultStringLength(191);
        Tasks::status_controller();
    }
}
