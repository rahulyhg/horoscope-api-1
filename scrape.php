<?php
set_time_limit(1);
include_once 'simple_html_dom.php';
$sunsign=htmlspecialchars($_GET["sunsign"]);
if (!is_null($sunsign)) {

$url = "https://www.astrology.com/horoscope/daily/". $sunsign;

$html = file_get_html($url);

//remove additional spaces
$pat[0] = "/^\s+/";
$pat[1] = "/\s{2,}/";
$pat[2] = "/\s+\$/";
$rep[0] = "";
$rep[1] = " ";
$rep[2] = "";

/*foreach($html->find('div#daily') as $heading) { 

foreach($heading->find('div[class="page-horoscope-text-container"]', 0) as $text) { 
		echo $text->innertext.'<p>';
	  
}
}
*/



foreach($html->find('div[class="page-horoscope-text"]') as $heading) { //for each heading
        //find all spans with a inside then echo the found text out
		$date = preg_replace($pat, $rep, $heading->find('p')->plaintext) . "\n"; 
       // $forecast = preg_replace($pat, $rep, $heading->find('p')->plaintext) . "\n"; 
		 $forecast=$heading->innertext.'<p>';
}
}


$cars[1] = $sunsign;
$cars[2] = $forecast; 

echo json_encode($cars, JSON_FORCE_OBJECT);
?>