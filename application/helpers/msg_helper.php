<?php 

function alert($text, $type="success")
{
	$alert = "<div class='alert alert-$type'>";
	$alert .= $text;
	$alert .= "</div>";

	return $alert;
}
