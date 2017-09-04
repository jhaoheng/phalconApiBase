<?php  

/**
* Base UTC time
*/
class SYSTime
{

    protected $timestamp;

    function __construct()
    {
        $date = new DateTime();
        date_default_timezone_set("UTC");
        $this->timestamp = $date->getTimestamp();
    }

    public function getNowDate(){
        $timestamp = $this->timestamp;
        $UTC_nowDate = date('Y-m-d H:i:s', $timestamp).',UTC+0';
        return $UTC_nowDate;
    }
    public function getNowTimestamp(){
        return $this->timestamp;
    }

    public function getShiftTimestampWithHour($hour){
        $newTimestamp = $this->timestamp + 60*60*$hour;
        return $newTimestamp;
    }

    public function getShiftDateWithHour($hour){
        $newTimestamp = $this->timestamp + 60*60*$hour;
        $newDate = date('Y-m-d H:i:s', $newTimestamp).',UTC'.$hour;
        return $newDate;
    }
}
?>