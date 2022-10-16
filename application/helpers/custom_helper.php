<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * debug echo
 */
function nicevar($data, $title="", $break = false)
{
	echo"<pre style='background-color: #FFFECE; color: #000; font-size: 12px; padding-left: 10px; white-space:pre-wrap; white-space: pre-wrap;'>";
	echo"<strong style='padding: 2px 7px 2px 7px; display: inline-block; background-color: #000; color: #fff;'>$title</strong><br/><br/>";
	print_r($data);
	echo'</pre>';
    if($break){
        die();
    }
}

/**
 * nicelog
 * @param $name     string  filename of log
 * @param $msg      mixed   message
 * @param $title    string  optional string for cutom message
 */
function nicelog($name, $msg, $title = "LOG")
{
	$root = "./application/logs/nicelog/";
	
    $crlf = "\r\n";
    $_CI =& get_instance();
    $_CI->load->helper('file');
    $log_prefix = $title . ": " . date("Y-m-d H:i:s") . " --> ";
    if(is_array($msg) || is_object($msg)){
        $msg = print_r($msg, true);
    }
	
	$path = explode('/', $name);
	if (count($path) > 1) {
		array_pop($path); // Kill last because it's filename
		foreach ($path as $fld) {
			$walk[] = $fld;
			$walk_path = implode('/', $walk);
			if (!file_exists($root . $walk_path)) {
				mkdir ($root . $walk_path, 0777);
			}
		}
	}
	
    $logfile = $root . $name . ".log";

    write_file($logfile, $log_prefix . $msg . $crlf, 'at');
}