<?php
namespace Mirbaagheri\Cart;

use Illuminate\Auth\Events\Logout;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('cart', 'Mirbaagheri\Cart\Cart');

        $config = __DIR__.'/Config/cart.php';
        $this->mergeConfigFrom($config, 'cart');

        $this->publishes([__DIR__.'/Config/cart.php' => config_path('cart.php')], 'config');

        $this->app['events']->listen(Logout::class, function () {
            if ($this->app['config']->get('cart.destroy_on_logout')) {
                $this->app->make(SessionManager::class)->forget('cart');
            }
        });

        $this->publishes([
            realpath(__DIR__.'/Database/migrations') => $this->app->databasePath().'/migrations',
        ], 'migrations');
    }
}
