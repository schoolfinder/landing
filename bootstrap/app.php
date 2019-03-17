<?php
    session_start();

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Respect\Validation\Validator as v;
    use SchoolFinder\Classes\Config as get;
    
    use \Illuminate\Database\Capsule\Manager as Capsule;
    use Monolog\Formatter\LineFormatter;


    require __DIR__.'/../vendor/autoload.php';

    $mode = file_get_contents(__DIR__.'/../configuration');

    $app = new \Slim\App(get::configuration($mode));

    $container = $app->getContainer();

    $log = $container->get('settings')['logger'];
    $db_conn = $container->get('settings')['db'];
    $app_config = $container->get('app');

    $mailer = $container->get('settings')['mail'];
    $sms = $container->get('settings')['sms'];

    $capsule = new Capsule;
    $capsule->addConnection($db_conn);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $container['db'] = function ($container) use ($capsule){
        return $capsule;
    };

    $container['view'] = function ($container) use ($app_config){
        $view = new \Slim\Views\Twig(__DIR__.'/../resources', [
            'cache' => false
        ]);

        $view->addExtension(new \Slim\Views\TwigExtension(
            $container->router, $container->request->getUri()
        ));

        $view->getEnvironment()->addGlobal('app', $app_config);

        $view->getEnvironment()->addGlobal('session', [
            
        ]);

        //$view->getEnvironment()->addGlobal('flash', $container->flash);

        return $view;
    };

    $container['logger'] = function ($container) use ($log){
        $date = date('Y-m-d');
        $log_file = "log-{$date}.log";

        $dateFormat = "Y-m-d H:i:s";
        $output = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";

        $formatter = new LineFormatter($output, $dateFormat);

        $logger = new \Monolog\Logger($log['name']);
        $file_handler = new \Monolog\Handler\StreamHandler(__DIR__.'/../logs/'.$log_file, $logger::DEBUG);
        $file_handler->setFormatter($formatter);
        $logger->pushHandler($file_handler);
        
        return $logger;
    };

    $container['csrf'] = function ($container){
        $csrf = new \Slim\Csrf\Guard;
        $csrf->setPersistentTokenMode(true);

        $csrf->setFailureCallable(function ($request, $response, $next) use ($container) {
            $request = $request->withAttribute("csrf_status", false);

            //return $response->withRedirect($container->router->pathFor('auth.user-sign-out'));
        });
        
        return $csrf;
    };


    $container['WebController'] = function ($container){
        return new \SchoolFinder\Controllers\WebController($container);
    };

    require __DIR__.'/../routes/router.php';
