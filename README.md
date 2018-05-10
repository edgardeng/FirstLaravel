##First Laravel
> first app with laravel framework

## run

## Laravel 命令

查看路由
php artisan api:routes
php artisan route:list


composer require dingo/api:2.0.0-alpha1


在config/app.php注册到 providers 数组：

'providers' => [
    //...
    Dingo\Api\Provider\LaravelServiceProvider::class,
]

php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"