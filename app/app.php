<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Tamagotchi.php";

    session_start();
    if(empty($_SESSION['state_of_tamagotchi'])) {
        $_SESSION['state_of_tamagotchi'] = array();
    }

    $app= new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('tamagotchi.html.twig', array('tamagotchi' => Tamagotchi::getAll()));
    });

    $app->post("/tamagotchi", function() use ($app) {
        $tamagotchi = new Tamagotchi($_POST['name']);
        $tamagotchi->save();
        return $app['twig']->render('create_name.html.twig', array('newtamagotchi' => $tamagotchi));
    });

    $app->post("/kill_tamagotchi", function() use ($app) {
        Tamagotchi::deleteAll();
        return $app['twig']->render('kill_tamagotchi.html.twig');
    });

    $app->post("/feed_tamagotchi", function() use ($app) {
        $_SESSION['state_of_tamagotchi'][0]->setFood($_SESSION['state_of_tamagotchi'][0]->getFood() + 10);
        /*
        Tamagotchi::setFood() = Tamagotchi::getFood() + 10;
        Tamagotchi::save();
        */
        return $app['twig']->render('tamagotchi.html.twig', array('tamagotchi' => Tamagotchi::getAll()));
    });

    $app->post("/play_tamagotchi", function() use ($app) {
        $_SESSION['state_of_tamagotchi'][0]->setPlay($_SESSION['state_of_tamagotchi'][0]->getPlay() + 10);
        /*
        Tamagotchi::setPlay() = Tamagotchi::getPlay() + 10;
        Tamagotchi::save();
        */
        return $app['twig']->render('tamagotchi.html.twig', array('tamagotchi' => Tamagotchi::getAll()));
    });

    $app->post("/sleep_tamagotchi", function() use ($app) {
        $_SESSION['state_of_tamagotchi'][0]->setSleep($_SESSION['state_of_tamagotchi'][0]->getSleep() + 10);
        /*
        Tamagotchi::setSleep() = Tamagotchi::getSleep() + 10;
        Tamagotchi::save();
        */
        return $app['twig']->render('tamagotchi.html.twig', array('tamagotchi' => Tamagotchi::getAll()));
    });

    $app->post("/skip_time", function() use ($app) {
        $_SESSION['state_of_tamagotchi'][0]->setFood($_SESSION['state_of_tamagotchi'][0]->getFood() - 10);
        $_SESSION['state_of_tamagotchi'][0]->setPlay($_SESSION['state_of_tamagotchi'][0]->getPlay() - 10);
        $_SESSION['state_of_tamagotchi'][0]->setSleep($_SESSION['state_of_tamagotchi'][0]->getSleep() - 10);
        /*
        Tamagotchi::setFood() = Tamagotchi::getFood() - 10;
        Tamagotchi::setPlay() = Tamagotchi::getPlay() - 10;
        Tamagotchi::setSleep() = Tamagotchi::getSleep() - 10;
        Tamagotchi::save();
        */
        return $app['twig']->render('tamagotchi.html.twig', array('tamagotchi' => Tamagotchi::getAll()));
    });

    return $app;
?>
