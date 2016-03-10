<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app){
       return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
   $app['debug'] = true;

    $app->post("/add_stylist", function() use($app){
        $name = $_POST['name'];
        $new_stylist = new Stylist($name);
        $new_stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app){
       $stylist = Stylist::find($id);
       return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
   });

    $app->get("/stylists/{id}/edit", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist));
    });

    $app->post("/delete_stylists", function() use($app){
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists'=> Stylist::getAll()));
    });

    $app->patch("/stylists/{id}", function($id) use ($app){
        $new_name = $_POST['new_name'];
        $stylist = Stylist::find($id);
        $stylist->update($new_name);
        return $app['twig']->render('clients.html.twig', array('stylist'=> Stylist::getAll(), 'clients' => $stylist->getClients()));
    });

    $app->post("/add_client", function() use ($app){
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($name, $stylist_id, $id=null);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/clients/{id}", function($id) use ($app){
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    $app->patch("/clients/{id}", function($id) use ($app){
        $new_name = $_POST['new_name'];
        $client = Client::find($id);
        $client->update($new_name);
        return $app['twig']->render('index.html.twig', array('client'=>$client, 'stylists'=>Stylist::getAll()));
    });


    $app->delete("/clients/{id}", function($id) use ($app){
        $client = Client::find($id);
        $client->deleteClient();
        return $app['twig']->render('index.html.twig', array('stylists'=> Stylist::getAll()));
    });

    return $app;
 ?>
