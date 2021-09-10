<?php

//setting up the time zone
//it dependes on yourlocation or your pc.settings
define("TIMEZONE", "Africa/Dakar");

//define a default time zone
date_default_timezone_set(TIMEZONE);

//create a function who give use the time date the suer was connected
//refere to php function time Ago
function lastSeen($date_tme)
{
    $timestamp = strtolower($date_tme);

    $strTime = array(
        "second", "minute", "hour",
        "day", "month", "year"
    );
    $lenght = array("60", "60", "24", "30", "12", "10");
    $currentTime = time();


    if ($currentTime >= $timestamp) {
        $diff = time() - strtotime($timestamp);
        //juste pour tester return "time() est: ".time()." timestamp est: ".$timestamp. " la diff est de ".time()." - ".$timestamp." est ".$diff;

        for ($i = 0; ($diff >= $lenght[$i]) && $i < (count($lenght) - 1); $i++) {
            $diff = $diff / $lenght[$i];
        }

        $diff = round($diff);

        if ($diff < 59 && $strTime[$i] == "second") {
            return "Active"; //en ligne
        } else {
            //return the last time that is was connected
            return $diff . " " . $strTime[$i] . "(s) ago";
        }
    }
}
