<?php 

if(!function_exists('getYesNoClassName')) {
	function getYesNoClassName($value)
	{
		return ($value) ? 'success' : 'danger';
	}	
}
