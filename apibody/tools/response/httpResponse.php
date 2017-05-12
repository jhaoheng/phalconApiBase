<?php 

use Phalcon\Http\Response;

/**
 * [responseJsonFormat description]
 * @param  $api_status          true / false 用於當 http_status_code = 200 時，api 內部因參數等錯誤問題，回傳 false
 * @param  $api_content         response value, must need to use info
 * @param  $debug_msg           if debug mode==true, then it work.
 * @param  $api_code            0=NoError 用於自定義的 error code
 */
// function responseJsonFormat($api_status, $http_status_code=418, $api_content, $debug_msg=null, $api_code='NoDefine'){

//     $config = include APP_PATH . "/config/config.php";
//     $is_show_response_debug_msg = $config->is_show_response_debug_msg;

//     $content = array(
//             'api_status'        =>      $api_status,
//             'api_content'       =>      $api_content,
//             'api_code'          =>      $api_code,
//         );
    
//     if ($is_show_response_debug_msg) {
//         $content['debug_info'] = $debug_msg;
//     }

// }


/**
* 
*/
class httpResponse
{
    protected $http_status_code;
    protected $api_content;
    protected $debug_msg;
    protected $api_err_code;
    
    function __construct($http_status_code=418, $api_content=array(), $api_err_code=666, $debug_msg=null)
    {
        $this->http_status_code = $http_status_code;
        $this->api_content = $api_content;
        $this->api_err_code = $api_err_code;
        $this->debug_msg = $debug_msg;
    }

    public set_httpStatusCode($value){
        $this->http_status_code = $value;
    }

    public function set_apiContent($value){
        $this->api_content = $value;
    }

    public function set_apiErrCode($value){
        $this->api_err_code = $value;
    }

    public function set_debugMsg($value){
        $this->debug_msg = $value;
    }

    public function sendWithJsonFormat(){

        $config = include APP_PATH . "/config/config.php";

        $apiRes = array(
            'api_content'       =>      $this->api_content,
            'api_err_code'      =>      $this->api_err_code,
        );

        $is_show_response_debug_msg = $config->is_show_response_debug_msg;
        if ($is_show_response_debug_msg) {
            $apiRes['debug_info'] = $this->debug_msg;
        }

        $response = new Response();
        $response->setStatusCode($this->http_status_code);
        $response->setHeader("Content-Type", "application/json");
        $response->setJsonContent($apiRes);    
        $response->send();
    }

    public function sendWithGeneralFormat($httpCode, $content){

        $response = new Response();
        $response->setStatusCode($httpCode);
        $response->setContent($content);
        $response->send();
    }
}

?>