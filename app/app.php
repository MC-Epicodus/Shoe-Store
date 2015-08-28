<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Element.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";
    
        $server = 'mysql:host=localhost;dbname=shoes';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);


    $app = new Silex\Application();
    $app['debug']  = true;
    $app->register(new Silex\Provider\TwigServiceProvider(),array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app){
            $new_store = new Store("Store Name");
            $new_store->save();
            return $app['twig']->render('index.html.twig',array('stores' => Store::getAll()));
    });

    return $app;

?>
