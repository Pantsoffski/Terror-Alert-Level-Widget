<?php

function TerrorAlertFetch() {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://feeds.bbci.co.uk/news/world/rss.xml");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch,CURLOPT_MAXREDIRS,10);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,70);
		curl_setopt($ch,CURLOPT_USERAGENT,"terror alert level");
		curl_setopt($ch,CURLOPT_HTTP_VERSION,'CURLOPT_HTTP_VERSION_1_1');
	$data = curl_exec($ch);
	$data = strip_tags($data); //wywala cały html
	$data = trim(preg_replace('/\s+/', ' ', $data)); //usuwa wszystkie, niepotrzebne przerwy, entery itp.

	function MatchTextAndCount($data){
 		$matches = array();
    	$pattern = "/attack|attacker|terror|terrorist/";
    	preg_match_all($pattern, $data, $matches);
    	var_dump($matches);
 	}

	return MatchTextAndCount($data);
}

?>