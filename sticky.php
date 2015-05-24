<?php
	require 'simple_html_dom.php';
	$html = new simple_html_dom();
	$html->load_file('http://forum.tirkx.com/main/forumdisplay.php?74');
	$output = array();
	foreach($html->find("#stickies > li > div.sticky") as $topic){
		$topic_info = $topic->find(".threadinfo > .inner > .threadtitle > a");
		$reply = $topic->find(".threadstats > li> a.understate",0)->plaintext;
		$reply = intval(str_replace(",","",$reply));
		$view = $topic->find(".threadstats > li",1)->plaintext;
		$view = intval(str_replace(",","",substr($view,7,strlen($view))));
		$result = array(
			"id"=>intval(substr($topic_info[0]->id,13,strlen($topic_info[0]->id))),
			"name"=>$topic_info[0]->plaintext,
			"view"=>$view,
			"reply"=>$reply		
		);
		array_push($output,$result);
	}
	echo json_encode($output);
?>