<?php

ini_set('display_errors', 'Off'); 


// ПОЛУЧЕНИЕ ДАННЫХ 
$request_body = file_get_contents('php://input');

if(!isset($request_body)) {
	die("Access Denied");
	exit;
}



$data = json_decode($request_body);



// ПОДКЛЮЧЕНИЕ К БД 
$serverName = "localhost\\sqlexpress, 1433"; 
$connectionInfo = array( "Database"=>"DronTaxi", "UID"=>"sa", "PWD"=>"gfhjkbr23" , 'CharacterSet' => 'UTF-8');
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) {
    // echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     exit();	 
}

	$Number=  $data->{'Number'};
	$sql = "DELETE FROM [DronTaxi].[dbo].[Orders] WHERE Number = $Number" ;
	$qty = 0; $id = 0;
	$stmt = sqlsrv_prepare( $conn, $sql, array( &$qty, &$id));
	if( $stmt ) sqlsrv_execute( $stmt ); 

	
sqlsrv_close ( $conn ) ;
exit();


?>
 