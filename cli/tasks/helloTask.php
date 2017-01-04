<?php

class HelloTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        return include BASE_PATH."/apibody/hello.php"; 
    }

}