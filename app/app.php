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

                return $app['twig']->render('index.html2.twig',array('stores' => Store::getAll()));
        });

        $app->post("/", function() use ($app){

            $new_store = new Store($_POST['store_name']);
            $new_store->save();

            return $app['twig']->render('index.html.twig',array('stores' => Store::getAll()));
        });

        $app->get("/store/{id}", function($id) use ($app){
            $store = Store::find($id);
            return $app['twig']->render('store.html.twig',array('brands' => $store->getBrands(), 'store' => $store));
        });

        $app->post("/store/{id}", function($id) use ($app){
            $store = Store::find($id);
            $brand = new Brand($_POST['brand_name']);
            $brand->save();
            $store->addBrand($brand);
            return $app['twig']->render('store.html.twig',array('brands' => $store->getBrands(), 'store' => $store));
        });

        $app->get("/delete_all", function() use ($app) {
            Brand::deleteAll();
            Store::deleteAll();
            return $app['twig']->render('index.html.twig',array('stores' => Store::getAll()));
        });

            $app->get("/brand/{id}", function($id) use ($app){
            $brand = Brand::find($id);
            return $app['twig']->render('brand.html.twig',array('stores' => $brand->getStores(), 'brand' => $brand));
        });


            $app->post("/brand/{id}", function($id) use ($app){
            $brand = Brand::find($id);
            $store = new Store($_POST['store_name']);
            $store->save();
            $brand->addStore($store);
            return $app['twig']->render('brand.html.twig',array('stores' => $brand->getStores(), 'brand' => $brand));
        });
    return $app;

?>
