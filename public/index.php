<?php

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    //Setup the database service
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "127.0.0.1",
            "port" => "3306",
            "username" => "root",
            "password" => "",
            "dbname" => "PhalconApp"
        ));
    });

    //Setup the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    //Setup a base URI so that all generated URIs include the "PhalconApp" folder
    $di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/PhalconApp/');
        return $url;
    });

    $di->set('flash', function(){
        $flash = new \Phalcon\Flash\Session(array(
            'error'     => 'alert alert-danger',
            'success'   => 'alert alert-success',
            'notice'    => 'alert alert-info',
            'warning'   => 'alert alert-warning'
        ));    
        return $flash;
    });

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}

