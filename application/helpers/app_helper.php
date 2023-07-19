<?php
function base_theme($url,$raw=FALSE)
{
	$ci =& get_instance();
	$theme = used_theme();
	$theme_path = 'application/views/template';
	if ($raw) {

		$url = trim($url,"/");

		$file = $theme_path.$theme.'/'.$url;

		return $file;
	} else {

		$url = ltrim($url,"/");
		return base_url('theme/'.$theme.'/'.$url);	
	}
}

?>
