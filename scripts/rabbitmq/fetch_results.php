<?php

include_once 'vendor/autoload.php';

use GuzzleHttp\Psr7\Request;


//curl 'http://127.0.0.1:8085/api/queues/%2F/test/get' -H 'Origin: http://127.0.0.1:8085' -H 'Accept-Encoding: gzip, deflate' -H 'Accept-Language: en-US,en;q=0.8,pt;q=0.6' -H 'authorization: Basic Z3Vlc3Q6Z3Vlc3Q=' -H 'Content-Type: text/plain;charset=UTF-8' -H 'Accept: */*' -H 'Referer: http://127.0.0.1:8085/' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36' -H 'Connection: keep-alive' --data-binary '{"vhost":"/","name":"test","truncate":"50000","requeue":"true","encoding":"auto","count":"1000"}' --compressed
//


// Create a client with a base URI
$client = new GuzzleHttp\Client( array('base_uri' => 'http://127.0.0.1:8085/api/','auth' => array('guest', 'guest')));
$request = new Request('POST', 'queues/%2F/test/get',  array("Accept-Encoding" => "gzip, deflate" ));

$response = $client->send($request, array('body' => '{"vhost":"/","name":"test","truncate":"50000","requeue":"true","encoding":"auto","count":"10000"}') );

$data = $response->getBody();

$messages = json_decode($data, true);


foreach($messages as $msg){
  $results_data = $msg['payload'];


  $results = json_decode(gzuncompress(base64_decode($results_data)),true);

  foreach ($results as $result) {
        if($result['device_id'] == "30dda81b444af01a1431101a4e0aa601"){
          echo $result["type"]." : ".$result["check_id"]. ":".$result['executed_at'] ."\n";
        }
  }

/*
  if(isset($results["extra_data"])){
      if($results["extra_data"]['device_id'] == "30dda81b444af01a1431101a4e0aa601")
      {

        print_r($results["extra_data"]);
      }
  }else {
    if($results['device_id'] == "30dda81b444af01a1431101a4e0aa601"){
      print_r($results);
    }
  }

  */
}
