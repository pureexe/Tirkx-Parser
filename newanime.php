<?php
	$input = file_get_contents('http://forum.tirkx.com/main/tirkx_anime_list_home.php');
	$output = array();
	$limits = 0;
	if(isset($_GET['limit'])){
		$limits = intval($_GET['limit']);
	}
	foreach(explode("`",$input) as $topic){
		$result = explode("$",$topic);
		if($limits==0||count($output)<$limits){
			if(count($result)==5){
				$result = array("aid"=>intval($result[1]),"filename"=>$result[2],"md5"=>$result[0],"lang"=>$result[3],"streaming"=>($result[4]=="true")?true:false);
				array_push($output,$result);
			}
		}else{
			break;
		}
	}
	echo json_encode($output);
?>