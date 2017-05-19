<?php

include_once BASE_PATH ."/apibody/tools/time/time.php";

/**
* 
*/
class SlackManager
{
    
    public $slackUrl;
    public $slackChannel;
    public $slackBotName;
    public $slack_icon_emoji;
    public $project;

    function __construct()
    {
        $config = include BASE_PATH."/app/config/config.php";
        $slackConfig = $config->notification->slack;

        $this->slackUrl = $slackConfig->botUrl;
        $this->slackChannel = $slackConfig->slackChannel;
        $this->slackBotName = $slackConfig->botName;
        $this->slack_icon_emoji = $slackConfig->botIconEmoji;
        $this->project = basename ( BASE_PATH );
    }

    public function slackBot($text=''){


        $slackUrl = $this->slackUrl;
        $slackChannel = $this->slackChannel;
        $slackBotName = $this->slackBotName;
        $slack_icon_emoji = $this->slack_icon_emoji;
        $project = $this->project;


        if (empty($text)) {
            $text = "no get message";
        }

        $systime = new SYSTime;
        $date = $systime->getNowDate();

        $text = '【project】: '.$project.PHP_EOL.$text;

        $payload = array(
            "channel" => $slackChannel,
            "username" => $date." ".$slackBotName,
            "text" => $text,
            "icon_emoji" => $slack_icon_emoji
        );

        $data = "payload=".json_encode($payload);


        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$slackUrl);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
        // Execute
        $result=curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        echo $result." => ". $httpcode.PHP_EOL;
    } 
}
?>