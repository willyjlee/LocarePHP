<?php

$resp = array();

$jsonstring = file_get_contents('php://input');
$jsonobj = json_decode($jsonstring, true);

    require_once __DIR__ . '/db_connect.php';
    $con = mysqli_connect("localhost","root","","locare");
    if($con==FALSE){
        $resp['result'] = -2;
        echo json_encode($resp);
        exit("can't connect to db");
    }
    $db = mysqli_select_db($con, "locare");
    if($db==FALSE){
        $resp['result'] = -1;
        echo json_encode($resp);
        exit("can't select db");
    }

    $user = $jsonobj['username'];

    $loc = $jsonobj['location'];

    $date = $jsonobj['date'];

    $time = $jsonobj['time'];

    $res = mysqli_query($con, "INSERT INTO data(username, location, datestr, timestr) VALUES ('$user', '$loc', '$date', '$time')");

    $resp['res of query']=$res;

    if($res){
        $resp['result']=1; //yes
    }else{
        $resp['result']=0; //no
    }

echo json_encode($resp);
mysqli_close($con);

?>
