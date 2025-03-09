<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage STUDEON
 * @since STUDEON 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('studeon_storage_get')) {
	function studeon_storage_get($var_name, $default='') {
		global $STUDEON_STORAGE;
		return isset($STUDEON_STORAGE[$var_name]) ? $STUDEON_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('studeon_storage_set')) {
	function studeon_storage_set($var_name, $value) {
		global $STUDEON_STORAGE;
		$STUDEON_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('studeon_storage_empty')) {
	function studeon_storage_empty($var_name, $key='', $key2='') {
		global $STUDEON_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($STUDEON_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($STUDEON_STORAGE[$var_name][$key]);
		else
			return empty($STUDEON_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('studeon_storage_isset')) {
	function studeon_storage_isset($var_name, $key='', $key2='') {
		global $STUDEON_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($STUDEON_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($STUDEON_STORAGE[$var_name][$key]);
		else
			return isset($STUDEON_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('studeon_storage_inc')) {
	function studeon_storage_inc($var_name, $value=1) {
		global $STUDEON_STORAGE;
		if (empty($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = 0;
		$STUDEON_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('studeon_storage_concat')) {
	function studeon_storage_concat($var_name, $value) {
		global $STUDEON_STORAGE;
		if (empty($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = '';
		$STUDEON_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('studeon_storage_get_array')) {
	function studeon_storage_get_array($var_name, $key, $key2='', $default='') {
		global $STUDEON_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($STUDEON_STORAGE[$var_name][$key]) ? $STUDEON_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($STUDEON_STORAGE[$var_name][$key][$key2]) ? $STUDEON_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('studeon_storage_set_array')) {
	function studeon_storage_set_array($var_name, $key, $value) {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if ($key==='')
			$STUDEON_STORAGE[$var_name][] = $value;
		else
			$STUDEON_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('studeon_storage_set_array2')) {
	function studeon_storage_set_array2($var_name, $key, $key2, $value) {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if (!isset($STUDEON_STORAGE[$var_name][$key])) $STUDEON_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$STUDEON_STORAGE[$var_name][$key][] = $value;
		else
			$STUDEON_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('studeon_storage_merge_array')) {
	function studeon_storage_merge_array($var_name, $key, $value) {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if ($key==='')
			$STUDEON_STORAGE[$var_name] = array_merge($STUDEON_STORAGE[$var_name], $value);
		else
			$STUDEON_STORAGE[$var_name][$key] = array_merge($STUDEON_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('studeon_storage_set_array_after')) {
	function studeon_storage_set_array_after($var_name, $after, $key, $value='') {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if (is_array($key))
			studeon_array_insert_after($STUDEON_STORAGE[$var_name], $after, $key);
		else
			studeon_array_insert_after($STUDEON_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('studeon_storage_set_array_before')) {
	function studeon_storage_set_array_before($var_name, $before, $key, $value='') {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if (is_array($key))
			studeon_array_insert_before($STUDEON_STORAGE[$var_name], $before, $key);
		else
			studeon_array_insert_before($STUDEON_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('studeon_storage_push_array')) {
	function studeon_storage_push_array($var_name, $key, $value) {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($STUDEON_STORAGE[$var_name], $value);
		else {
			if (!isset($STUDEON_STORAGE[$var_name][$key])) $STUDEON_STORAGE[$var_name][$key] = array();
			array_push($STUDEON_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('studeon_storage_pop_array')) {
	function studeon_storage_pop_array($var_name, $key='', $defa='') {
		global $STUDEON_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($STUDEON_STORAGE[$var_name]) && is_array($STUDEON_STORAGE[$var_name]) && count($STUDEON_STORAGE[$var_name]) > 0) 
				$rez = array_pop($STUDEON_STORAGE[$var_name]);
		} else {
			if (isset($STUDEON_STORAGE[$var_name][$key]) && is_array($STUDEON_STORAGE[$var_name][$key]) && count($STUDEON_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($STUDEON_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('studeon_storage_inc_array')) {
	function studeon_storage_inc_array($var_name, $key, $value=1) {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if (empty($STUDEON_STORAGE[$var_name][$key])) $STUDEON_STORAGE[$var_name][$key] = 0;
		$STUDEON_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('studeon_storage_concat_array')) {
	function studeon_storage_concat_array($var_name, $key, $value) {
		global $STUDEON_STORAGE;
		if (!isset($STUDEON_STORAGE[$var_name])) $STUDEON_STORAGE[$var_name] = array();
		if (empty($STUDEON_STORAGE[$var_name][$key])) $STUDEON_STORAGE[$var_name][$key] = '';
		$STUDEON_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('studeon_storage_call_obj_method')) {
	function studeon_storage_call_obj_method($var_name, $method, $param=null) {
		global $STUDEON_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($STUDEON_STORAGE[$var_name]) ? $STUDEON_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($STUDEON_STORAGE[$var_name]) ? $STUDEON_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('studeon_storage_get_obj_property')) {
	function studeon_storage_get_obj_property($var_name, $prop, $default='') {
		global $STUDEON_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($STUDEON_STORAGE[$var_name]->$prop) ? $STUDEON_STORAGE[$var_name]->$prop : $default;
	}
}
?>