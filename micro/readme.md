
# how to create a new http api

1. create your apibody php file in `apibody` folder 
2. open `microInterface.php`, and setting a new one interface api

	```
	$app->get('/hello', function (){
	    return include BASE_PATH."/apibody/hello.php";
	});
	```
 3. open browser and request `[dns]/hello`