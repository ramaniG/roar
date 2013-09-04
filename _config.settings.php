<?php  

/*
 * Created by Jason Phoon
 * Date Created: 20/1/2013
 * 
 * */

switch ($_SERVER['HTTP_HOST']) 
{

	//= Localhost ============================================
	case 'localhost': 
	case '127.0.0.1': 

		define ( 'BASE', 'http://'.$_SERVER['HTTP_HOST'].'/roar' );
		
		define ( 'DB_HOST', '127.0.0.1' );
		define ( 'DB_NAME', 'roar2' );
		define ( 'DB_USER', 'root' );
		define ( 'DB_PASS', '' );

		define ( 'SMTP_HOST', '' );
		define ( 'SMTP_USER', '' );
		define ( 'SMTP_PASS', '' );
		
	break;
	
	//= Production ============================================
	case 'www.roar.com':
	case 'roar.com':
		/*
		define ( 'BASE', 'http://www.roar.com' );
		
		define ( 'DB_HOST', 'localhost' );
		define ( 'DB_NAME', 'winsonco_db' );
		define ( 'DB_USER', 'winsonco_user88' );
		define ( 'DB_PASS', 'fBCFzk9d' );

		define ( 'SMTP_HOST', '' );
		define ( 'SMTP_USER', '' );
		define ( 'SMTP_PASS', '' );
		*/
	break;			

}
	//+======================================================================================

	//SYSTEM CONSTANTS
	define( 'SESSION_TIMEOUT', 30 );
	define( 'MULTIPLE_LOGIN', 0);
	
	//DEFINITION
	DEFINE('UPDATECHANGEPASSWORDMSG','Password is updated successfully');
	DEFINE('STUDIOAPRICE',45);
	DEFINE('STUDIOBPRICE',35);
	DEFINE('ADMINEMAIL', 'ramani_g@hotmail.com');
	
	//SYSTEM FUNCTIONS PATH
	require_once ('assets/php/database.php');
	require_once ('assets/php/func.php');
	require_once ('assets/php/module.php');
	
	define('_CAPTCHA', 'assets/captcha/captcha_code_file.php');
	
	//SYSTEM JS, JQUERY AND CSS PATH
	define( '_HTML5', BASE.'/assets/js/html5.js');
	define( '_JQUERYVALIDATION', BASE.'/assets/js/jquery.validation.js');
	define( '_COREJS', BASE.'/assets/js/core.js');
	
	define( '_CSS', BASE.'/assets/css/style.css');
	define( '_MEMBERCSS', BASE.'/assets/css/member.css');
	
	define('_BOOTSTRAP_JS', BASE.'/assets/bootstrap/js/bootstrap.min.js');
	define('_BOOTSTRAP_CSS', BASE.'/assets/bootstrap/css/bootstrap.min.css');
	
	define('_FANCYBOX_JS',BASE.'/assets/fancybox/jquery.fancybox.pack.js?v=2.0.6');
	define('_FANCYBOX_CSS',BASE.'/assets/fancybox/jquery.fancybox.css?v=2.0.6');
	
	define('_DATE_PICKER_CSS',BASE.'/assets/bootstrap/datepicker/css/datepicker.css');
	define('_DATE_PICKER_JS',BASE.'/assets/bootstrap/datepicker/js/bootstrap-datepicker.js');
?>