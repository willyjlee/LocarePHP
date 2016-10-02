<?php

    $resp = array();
    
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

    $res = mysql_query("SELECT * FROM location_table");
    if(mysql_num_rows($res)>0){
        $resp['entries']=array();
        while($r = mysql_fetch_array($res)){
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
    
?>