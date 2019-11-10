<?php
$dateoutearly = "02:00 AM";
$dateoutearly=date("h:i A",strtotime($dateoutearly));

$dateoutlate = "03:00 PM";
$dateoutlate=date("h:i A",strtotime($dateoutlate));

if($dateoutearly > $dateoutlate){
	echo 'true';
}else{
	echo 'false';
}