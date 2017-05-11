<?php  
// 
// include_once BASE_PATH."/apibody/tools/index.php";
// 

defined('TOOL_PATH') || define('TOOL_PATH', BASE_PATH . '/apibody/tools');

include_once TOOL_PATH."/database/mysql_manager.php";
include_once TOOL_PATH."/database/postgresql_manager.php";
include_once TOOL_PATH."/database/mongodb.php";

?>