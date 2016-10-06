<?php

    $resp = array();
    
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

    $res = mysqli_query($con, "SELECT * FROM data");
    if(mysqli_num_rows($res)>0){
        $resp['entries']=array();
        while($r = mysqli_fetch_array($res)){
            $add=array();
            $add['username']=$r['username'];
            $add['location']=$r['location'];
            $add['date']=$r['datestr'];
            $add['time']=$r['timestr'];
            array_push($resp['entries'], $add);
        }
        $resp['result']=1;
    }else{
        $resp['result']=0;
    }
    echo json_encode($resp);
    mysqli_close($con);    
?>
