<?php

require("./Router.php");

$router = new Router();

$router->get('/auth', function(){
    return 'GET OK';
});

$router->post('/auth/signup', function(){
    return 'POST OK';
});

try{

    $action = $router->resolve();
    print($action());

}catch(HttpNotFoundException $e){
    print('Not Found');
    http_response_code(404);
}

