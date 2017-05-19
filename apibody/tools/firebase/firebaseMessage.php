<?php

use Phalcon\Db\Adapter\Pdo\Mysql;

/**
* 
*/
class Firebase
{
    public $key;
    public $inValid_token;
    
    function __construct()
    {
        $config = include BASE_PATH."/app/config/config.php";
        $this->key = $config->notification->firebaseKey;
    }

    /**
     * [sendInBackground description]
     * @param  [array] $registrationIds [firebase 的 push_token]
     *            - 格式 ['token_1', 'token_2']
     * @return [type]                  [description]
     */
    public function send($registrationIds, $title, $body, $badge=0, $others="", $sound=1, $vibrate=1){

        if (count($registrationIds)==0) {
            return "No Firebase Instance ID";
        }

        $msg = array
        (
            'title'     => $title,
            'body'      => $body,
            'badge'     => $badge,
            'others'    => "",
            'sound'     => $sound,
            'vibrate'   => $vibrate
        );
        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'notification'      => $msg,
            'priority'          => 10, //貌似是優先權,iOS不加會收不到推播,Android可不加
        );
         
        $headers = array
        (
            'Authorization: key=' . $this->key,
            'Content-Type: application/json'
        );
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        $this->deleteFailToken($registrationIds, $resultOfSender);
        return $result;
    } 

    // 當 token 無效時，由此產生無效 token 的收集
    // 再去適當的 db 進行刪除
    /**
     * [deleteFailToken description]
     * @param  [type] $registrationIds [所有要推送的 push token]
     * @param  [type] $resultOfSender  [推送過後 firebase 的 result]
     * @return [type]                  [description]
     */
    public function deleteFailToken($registrationIds, $resultOfSender){
        $r = json_decode($resultOfSender);
        $success = $r->results;
        foreach ($success as $key => $value) {
            if (array_key_exists('error', $value)) {
                // echo "error : ".$registrationIds[$key];
                $this->inValid_token = $registrationIds;
                return $registrationIds;
            }
        }
    }
}


?>