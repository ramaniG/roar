<?php
	function current_page_name()
	 {
	   $url = explode('/',$_SERVER['PHP_SELF']);
	   $current_url = $url[count($url)-1];
	   return $current_url;
	 }
	 function safe_input($value){
    	$value = htmlspecialchars(trim($value));
    	if (get_magic_quotes_gpc()) $value = stripslashes($value);
   		return $value;
	 }
	
	function create_folder($path) {
	   return is_dir($path) || mkdir($path,0700,true);
	}
	
	//Enumeration Class
	class BookingStatus {
	    const REJECT = 'reject';
	    const APPROVED = 'approved';
	    const NEWBOOKING = 'new';
	}
	
	class MemberAccount {
		const ACTIVATE = 'activate';
	    const CLOSE = 'close';
	    const BLACKLIST = 'blacklist';
	}
	
 ?>