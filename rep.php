<?php 
error_reporting(0); 
include 'curl.php';

// edit with your token
$token = 'eyJraWQiOiI5bWc0WGsrajl6OXRxVXFWb3ZSUUR5d1lLdkZcL0ZWaHVXaTUrRXI1WDFuVT0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiI2YTQ4Njg2ZS00NzcyLTRmMWYtYmUyMS02ZDEyYjgzZjFlMWQiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLmFwLXNvdXRoZWFzdC0xLmFtYXpvbmF3cy5jb21cL2FwLXNvdXRoZWFzdC0xX2FjRTlUNHVCayIsImNvZ25pdG86dXNlcm5hbWUiOiI2NDk4NWQ5Mi02MGZkLTQwYzctYWRmYy04ZmNjYmM4NTJhMDMiLCJvcmlnaW5fanRpIjoiYjAzZTYyNDgtNDFjZi00MjRhLTljZmEtYzM3YmNkMzc3OWI4IiwiYXVkIjoiM3U0ZGc1NzMyc3FyZ2dlbnUxNWI5NGpyYmkiLCJldmVudF9pZCI6IjNjZTY3MDFiLWQ0ZWItNDI5Ni1iNmY4LTMyZWU3ODE4ZTM2MiIsInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNjk1NjY2NDMyLCJleHAiOjE2OTYxNDY0NjMsImlhdCI6MTY5NjE0Mjg2MywianRpIjoiNjBlNzJhNGMtNTcwMS00ZDlkLWE1NDAtZDg2YjQxOTE1NjQ0IiwiZW1haWwiOiJkYWhsYXdpZmF1amlAZ21haWwuY29tIn0.jccsb2Z6Id-GMu2Lc2mG8x2ya2PKxl95iWGNrsEGCRHBBvxaX0EYhjX2SWhfDzmX8SJXzhkQ1Cf2VWhD95BggrcMr3jujHyLFyLKHT-jnboZ0rpFkDd457Mt-QI3st87G3zYswRGiMUPoPhiHx6rfbwza4yp9LSQgR8sHdreEERVENHH3UQovc2nsTYxa9RZs288wo0ZAnkanvhDf6xPNr_AwMM-lc-exQ-L3vwBVIhEhR_vTIhPqj_OlGPjc1BT_kcOERKevrduJ9bP6n4yTAkvGx94NR1ywLkDu4uxZINkX1kYkno8klFRNWtiAV6DNqhTjpKHYZG51TVlLoIEmA';
//edit with target id
$id_target = '116925739975739183792';



$headers = [
	'authority: 657a5yyhsb.execute-api.ap-southeast-1.amazonaws.com',
	'accept: application/json, text/plain, */*',
	'accept-language: en-US,en;q=0.9',
	'authorization: Bearer '.$token,
	'origin: https://app.republik.gg',
	'referer: https://app.republik.gg/',
	'sec-ch-ua: "Chromium";v="116", "Not)A;Brand";v="24", "Opera";v="102"',
	'sec-ch-ua-mobile: ?1',
	'sec-ch-ua-platform: "Android"',
	'sec-fetch-dest: empty',
	'sec-fetch-mode: cors',
	'sec-fetch-site: cross-site',
	'user-agent: Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36',
	'x-custom-app-version-tag: 6.0.2'
];


$initialUrl = 'https://657a5yyhsb.execute-api.ap-southeast-1.amazonaws.com/production/profile/'.$id_target.'/relations?q=&lastKey=&followers=false';
$nextStartAt = '';

while (true) {
	$url = $nextStartAt ? $initialUrl . '&startAt=' . urlencode($nextStartAt) : $initialUrl;

	$page_follower = curl($url, null, $headers, false);

	$json_follower = json_decode($page_follower, true);
	$count = count($json_follower['users']);

	for ($i = 0; $i < $count; $i++) {
     
		$follow = curl('https://657a5yyhsb.execute-api.ap-southeast-1.amazonaws.com/production/profile/'.$json_follower['users'][$i]['id'].'/followers', '{}', $headers, false);
		$json_follow = json_decode($follow, true);

	echo  'Username : '.$json_follower['users'][$i]['displayName'].' | '.$json_follow['followStatus']. PHP_EOL;

	}

	$nextStartAt = isset($json_follower['lastKey']) ? $json_follower['lastKey'] : '';

	if (empty($nextStartAt)) {
		break;
	}
}





