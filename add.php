<?php

$resp = array();

$jsonstring = file_get_contents('php://input');
$jsonobj = json_decode($jsonstring, true);

//if(isset($jsonobj['location'])&&isset($jsonobj['datetime'])&&isset($jsonobj['status'])){
    require_once __DIR__ . '/db_connect.php';
    $con = new DB_CONNECT();
    if($con==FALSE){
        $resp['result'] = -2;
        echo json_encode($resp);
        exit("can't connect to db");
    }
    $db = DB_CONNECT::selectDB();
    if($db==FALSE){
        $resp['result'] = -1;
        echo json_encode($resp);
        exit("can't select db");
    }

    $user = $jsonobj['username'];
    //echo $user;

    $loc = $jsonobj['location'];
    //echo $loc;

    $date = $jsonobj['date'];
    //echo $date;

    $time = $jsonobj['time'];
    //echo $time;

    $res = mysql_query("INSERT INTO data(username, location, datestr, timestr) VALUES ('$user', $loc', '$date', $time')");
    if($res){
        $resp['result']=1; //yes
    }else{
        $resp['result']=0; //no
    }
// }else{
//     $resp['result']=-1;
// }
echo json_encode($resp);


//  if(isset($_POST['location'])&&isset($_POST['datetime'])&&isset($_POST['status'])){
     
//     require_once __DIR__ . '/db_connect.php';
//     $con = new DB_CONNECT();

//     $loc = $_POST['location'];
//     $time = $_POST['datetime'];
//     $stat = $_POST['status'];

//     $res = mysql_query("INSERT INTO location_table(location, datetime, status) VALUES ('$loc', '$time', '$stat')");
//     if($res){
//         $resp['result']=1; //yes
//     }else{
//         $resp['result']=0; //no
//     }
//  }else{
//      $resp['result']=-1;
//  }
//  echo json_encode($resp);

 
?>