
# how to run

1. `php run` or `php index.php` will execute default action
2. `php run [first] [second] [others...]`
	- [first] : task name
	- [seconde] : action method
	- [others] : params

# how to build cli task api

1. Create a new `hello.php` file in `apibody` folder, and do something in it.

	```
	<?php  
	echo "world";
	?>
	```
2. Create a php file in 'tasks' folder, and named it with 'xxxxTask.php', just like `helloTask.php`.

	```
	<?php
	
	class HelloTask extends \Phalcon\Cli\Task
	{
	    public function mainAction()
	    {
	        return include BASE_PATH."/apibody/hello.php"; 
	    }
	}
	```
3. run `php run hello`
