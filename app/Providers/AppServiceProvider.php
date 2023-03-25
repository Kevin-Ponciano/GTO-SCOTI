<?php

namespace App\Providers;

use App\Http\Livewire\Tasks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });
        Schema::defaultStringLength(191);
        #Criar uma tarefa que rode todos os dias para executar status_controller
        #Porem precisa ser feito algo para que quando uma tarefa for criada o
        #status_controller execute nesta tarefa todo
        Tasks::status_controller();
    }
}
