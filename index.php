<?php
echo 'API url';
$url = 'http://185.209.160.26:9091/API';
$password = 'V7Gam3y9Wg';


/*
$aparser = 'http://185.209.160.26:9091/API';

$request = json_encode(array(
    'action' => 'getTasksList',
    'data' => array (
        'completed' => '1'
    ),
    'password' => 'V7Gam3y9Wg'
));

$ch = curl_init($aparser);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($request)));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));

$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response, true);
echo '<pre>';
print_r($response); */


function callCurlAPI($method,$url,$password,$postdata,$action) {
		
		
		$ch = curl_init($url);	

		$postfields =	json_encode(array(
			'action' => $action,
			'data' => $postdata,
			'password' => $password
		));
		
		
		$header = array('Content-Length: ' . strlen($postfields),
						'Content-Type: text/plain; charset=UTF-8'
						);
		
		switch ($method){ 
			
			case "POST":
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
				 break;
			case "PUT":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");	 	
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);				
				break;
			case "DELETE":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");	
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);				
				break;
			case "PATCH":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');	 
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
				break;
			case "GET":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
				break;
			default:
				if ($postfields)
				 $url = sprintf("%s?%s", $url, http_build_query($postfields));
		}

		
		
		//curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($postfields)));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain; charset=UTF-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = json_decode(curl_exec($ch), true);
	
		
		if (curl_errno($ch)) {
			$error_msg = curl_error($ch);
			print_r($error_msg);
		}

		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE); 
		curl_close($ch);
		return array( 'data' => $data, 'http_code' => $http_code );
}

/*
echo '<pre>';
echo '<h1>Principle of work</h1>';

$postdata = 
	array (
        'parser' => 'SE::Google',
        'preset' => 'Pages Count use Proxy',
        'query' => 'test'
    );
	
$getres = callCurlAPI($method='POST',$url,$password,$postdata,$action='oneRequest');

print_r($getres);	


echo '<h1>get Parser info</h1>';
		
$postdata = 
	array (	
        'parser' => 'SE::Google',
       // 'preset' => 'default',
      //  'query' => 'test'
    );
	
$getParsers = callCurlAPI($method='POST',$url,$password,$postdata,$action='getParserInfo');


	print_r($getParsers);	
	

echo '<h1>get Ping info</h1>';
	
$getPing = callCurlAPI($method='POST',$url,$password,$postdata='',$action='ping');

print_r($getPing);	


echo '<h1>get Paresr list info</h1>';


$getParserInfo = callCurlAPI($method='POST',$url,$password,$postdata='',$action='info');

print_r($getParserInfo);

echo '<h1>get parser Preset</h1>';

$postdata = 
	array (
        'parser' => 'SE::Google',
		'preset' => 'default'
    );

$getpreset = callCurlAPI($method='POST',$url,$password,$postdata,$action='getParserPreset');
	
print_r($getpreset);

/*
echo '<h1>get Proxies</h1>';

$getproxy = callCurlAPI($method='POST',$url,$password,$postdata='',$action='getProxies');
	
print_r($getproxy); 


echo '<h1>get Task List</h1>';
$postdata = array('completed' => 1);
$getproxy = callCurlAPI($method='POST',$url,$password,$postdata,$action='getTasksList');
	
print_r($getproxy);



	
echo '<pre>';
echo '<h1>get Task Conf</h1>';
$postdata = array('taskUid' => 1546);
$gettaskconf = callCurlAPI($method='POST',$url,$password,$postdata,$action='getTaskConf');
	
print_r($gettaskconf);

echo '<h1>get Task State</h1>';
$postdata = array('taskUid' => 1546);
$gettaskstate = callCurlAPI($method='POST',$url,$password,$postdata,$action='getTaskState');
	
print_r($gettaskstate);


echo '<h1>change Task Status</h1>';
$postdata = array('taskUid' => 1546,
					'toStatus'=>'starting');
$changeTaskStatus = callCurlAPI($method='POST',$url,$password,$postdata,$action='changeTaskStatus');
	
echo '<pre>';
print_r($changeTaskStatus);

exit;
*/

echo '<h1>Add Task</h1>';

$postdataadd = 

  
	array(
      "resultsFileName" => "api-test.txt",
      'parsers' => array(
        array(
            'SE::Google::Position',
            'default'
        )
    ),
      "uniqueQueries"=> 0,
      "keepUnique"=> 0,
      "resultsPrepend"=> "",
      "queries"=> [
        "testwww"
      ],
      "configPreset"=> "default",
      "moreOptions"=> 0,
      "queriesFrom"=> "text",
      "resultsUnique"=> "no",
      "doLog"=> "no",
      "queryFormat"=> "$ query",
      "resultsSaveTo"=> "file",
      "configOverrides"=> [],
      "resultsFormat"=> "$ p1.preset",
      "resultsAppend"=> "",
      "queryBuilders"=> []
 
);
$addTask = callCurlAPI($method='POST',$url,$password,$postdataadd,$action='addTask');
echo '<pre>';
print_r($addTask);
exit;
?>

<select name="parseroptions">
<option value="">Select Parser</option>
	<?php
	foreach($getParserInfo['data']['data']['availableParsers'] as $parserList){
		 
		// print_r($parserList);
		echo '<option value="">'.$parserList.'</option>';
		 
	}
	?>

</select>


