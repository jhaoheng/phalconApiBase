<?php

use Phalcon\Http\Response;

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

$app->get('/hello', function (){
    return include BASE_PATH."/apibody/hello.php";
});

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

/**
 * Not found handler
 */
$app->notFound(function () {
    // $this->response->setStatusCode(404, "Not Found")->sendHeaders();
    // echo $this['view']->render('404');
    
    $response = new Response();
    $response->setStatusCode(404, "Not Found")->sendHeaders();
    $response->setJsonContent(
        array(
            'status'        =>      false,
            'response'      =>      'The api not exist.'
        )
    );
    return $response;
});
