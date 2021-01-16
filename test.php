<?php
set_time_limit(0);
$pf = file_get_contents('proxies.txt'); // Read the file with the proxy list
$proxy_file = explode("\n", $pf); // Get each proxy
$total = $argv[1];
$current = $argv[2] - 1;
foreach (range(1, count($proxy_file)) as $key => $value)
{
	if ($key % $total != $current)
	{
    
		continue;
  }
  if (test($proxy_file[$value])) 
  {
    continue ;
  }
  test($proxy_file[$value]);
  
}

function test($proxy)
{
  $splited = explode(':', $proxy); // Separate IP and port
  $proxyIP = $splited[0];
  $port = $splited[1];
  $ch = curl_init("https://jsonplaceholder.typicode.com/todos/1");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
  //Set the proxy IP.
  curl_setopt($ch, CURLOPT_PROXY, $proxyIP);
  //Set the port.
  curl_setopt($ch, CURLOPT_PROXYPORT, $port);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  //Execute the request.
  $output = curl_exec($ch);
  $output_arry = json_decode($output, true);
  // $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if (curl_errno($ch)) {
    return false ;
  }
  if (empty($output_arry) || !is_array($output_arry)) {
    return false ;
  }
  if (json_decode($output, true)["userId"] == 1) {// Check if we get good result
    $working = fopen("working_proxies.txt", "a"); // Here we will write the good ones
    $check = explode("\n", $working); // Get each proxy

    if (in_array($proxy,$check,true)) {
      return false;
    }
    
    fwrite($working, $proxy . "\n"); // Check if we can connect to that IP and port
    print $proxy . "\n"; // Show the proxy
    fclose($working);
    return true;  
    
  }
  curl_close($ch);
}
exit;