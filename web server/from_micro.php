<?php

//http://kevindarrah.com/micro/ESP_part3/from_micro.php?unit=1&sensor=123

//loop through and grab variables off the URL
foreach($_REQUEST as $key => $value)
{
if($key =="unit"){
$unit = $value;
}

if($key =="sensor"){
$sensor = $value;
}
}//for each


// Create connection to SQL database
$con=mysqli_connect("localhost","id15571246_laukik","4#-K1Qk((EITugaM","id15571246_esp8266");// server, user, pass, database

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//update sensor value in database
mysqli_query($con,"UPDATE ESP_1 SET Sensor = $sensor
WHERE id=$unit");


//if we need to get the time from the internet, use this.  This sets teh timezone
date_default_timezone_set('America/New_York');
$t1 = date("gi");//many different possible formats, but this gives 12 hr format, and returns 1:23 as 123

//pull out the table
$result = mysqli_query($con,"SELECT * FROM ESP_1");//table select

//loop through the table and filter out data for this unit id
while($row = mysqli_fetch_array($result)) {
if($row['id'] == $unit){
$d1 = $row['LED'];
$d2 = $row['Sensor'];
//echo "_t1$t1##_d1$d1##_d2$d2##";
echo "{'LED':$d1,'Sensor':$d2}";
}

}//while

?>