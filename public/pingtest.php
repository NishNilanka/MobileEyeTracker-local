<?php

// Server IP address or hostname
$server = '192.168.1.100'; // Replace with your laptop's IP address

// Execute ping command and capture output
$command = "ping -c 4 $server"; // -c 4 sends 4 ping requests
$output = shell_exec($command);

// Display the ping test result
echo "<pre>$output</pre>";

?>
