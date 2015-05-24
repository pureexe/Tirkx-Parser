<?php
	require 'simple_html_dom.php';
	$page = 1;
	if(isset($_GET['page'])){
		$page = intval($_GET['page']);
	}
	$html = new simple_html_dom();
	$html->load_file('http://forum.tirkx.com/main/forumdisplay.php?74/page'.$page);
	$output = array();
	$checktext = $html->find(".threadpagenav > form.popupmenu > span > a.popupctrl",0)->plaintext;
	$checktext = explode (" of ",$checktext);
	$checktext[0] = substr($checktext[0],5,strlen($checktext[0]));
	if(intval($checktext[0])<=intval($checktext[1])){
		foreach($html->find("#threads > li > div.nonsticky") as $topic){
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
	}
	echo json_encode($output);
?>