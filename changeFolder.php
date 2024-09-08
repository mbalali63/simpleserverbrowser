<?php
require_once("functions.php");
if (isset($_GET['pathname']))
{
    if ($_GET['pathname'] === '__1_up')
    {
        $result = setCurrentPath(dirname(getCurrentPath()));
        $dateTime = date("Y-m-d H:i:s");
        $logMessage = "[$dateTime] This is the current directory: " . getCurrentPath() . "\n";
        file_put_contents("log.txt", $logMessage, FILE_APPEND);
        if ($result) {
            echo json_encode(["success"=>true,"data"=> getCurrentPath()]);
        }
        else
        {
            echo json_encode(["success"=>false]);
        }
    }
    else
    {
        setCurrentPath($_GET['pathname']);
        echo json_encode(["success"=>true]);
    }
}

