<?php

namespace Etherbase\App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class EtherbaseServiceProvider extends ServiceProvider {

    protected $middleware = [
        \Etherbase\Core\Plugin\Middleware\Plugin::class,
        \Etherbase\App\Http\Middleware\EncryptCookies::class,
        \Etherbase\App\Http\Middleware\WalledGarden::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Etherbase\App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Etherbase\App\Http\Middleware\RedirectIfAuthenticated::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router) {

        include dirname(__DIR__) . '/Http/routes.php';


        // Register middleware
        $httpKernel = $this->app['Illuminate\Contracts\Http\Kernel'];

        foreach ($this->middleware as $middleware) {
            $httpKernel->pushMiddleware($middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $router->middleware($key, $middleware);
        }

        //Loading views
        //$this->loadViewsFrom(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'resources/views', 'etherbase');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

        // Registering package libraries service providers

        $providers = [
            \Collective\Html\HtmlServiceProvider::class,
            \Laracasts\Flash\FlashServiceProvider::class,
            \Zizaco\Entrust\EntrustServiceProvider::class,
            \Stolz\Assets\Laravel\ServiceProvider::class,
            \Etherbase\Core\Plugin\PluginServiceProvider::class,
            \Etherbase\Core\Option\OptionServiceProvider::class,
            \Etherbase\Core\Post\PostServiceProvider::class,
            \Etherbase\Core\Taxonomy\TaxonomyServiceProvider::class
        ];

        $aliases = [
            'Form' => \Collective\Html\FormFacade::class,
            'Html' => \Collective\Html\HtmlFacade::class,
            'Flash' => \Laracasts\Flash\Flash::class,
            'Theme' => \YAAP\Theme\Facades\Theme::class,
            'Entrust' => \Zizaco\Entrust\EntrustFacade::class,
            'Plugin' => \Etherbase\Core\Plugin\PluginFacade::class,
            'Option' => \Etherbase\Core\Option\OptionFacade::class,
            'Post' => \Etherbase\Core\Post\PostFacade::class,
            'Taxonomy' => \Etherbase\Core\Taxonomy\TaxonomyFacade::class
        ];

        // Loading Package specific config files
        $this->mergeConfigFrom(dirname(dirname(__DIR__)) . '/config/app.php', 'app');
        $this->mergeConfigFrom(dirname(dirname(__DIR__)) . '/config/entrust.php', 'entrust');
        $this->mergeConfigFrom(dirname(dirname(__DIR__)) . '/config/auth.php', 'auth');

        foreach ($providers as $provider) {
            $this->app->register($provider);
        }

        foreach ($aliases as $alias => $class) {
            \Illuminate\Foundation\AliasLoader::getInstance()->alias($alias, $class);
        }

        require dirname(__DIR__) . '/Includes/Formatting.php';
    }

}
