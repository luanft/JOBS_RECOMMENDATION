<?php
require_once 'simple_html_dom.php';
require_once 'download.php';

$keys = array (
		"@salary",
		"@company",
		"@job",
		"@city",
		"@description",
		"@tag" 
);
$keys_map = array ();
$element_container = "";
// tìm key trong pattern
function find_key($pattern, $key, array $curent_path = array()) {
	// dem so node con
	$count = count ( $pattern->childNodes () );
	// duyet cac node con
	for($i = 0; $i < $count; $i ++) {
		$recur = array ();
		$recur [] = $i;
		$recur = array_merge ( $curent_path, $recur );
		if (! $pattern->childNodes ( $i )->childNodes ()) {
			if (trim ( $pattern->childNodes ( $i )->plaintext ) == $key) {
				return $recur;
			}
		}
		$data = find_key ( $pattern->childNodes ( $i ), $key, $recur );
		if ($data)
			return $data;
	}
	return null;
}
// phan tich cau truc pattern
function analyze_file_struct($file) {
	global $keys;
	global $element_container;
	$html = new simple_html_dom ();
	$html->load_file ( $file );
	$element_container = $html->childNodes ( 0 )->tag;
	if ($html->childNodes ( 0 )->class != '')
		$element_container .= '[class="' . $html->childNodes ( 0 )->class . '"]';
	else 
	{
		if ($html->childNodes ( 0 )->id != '')
			$element_container .= '[id="' . $html->childNodes ( 0 )->id . '"]';
	}
	$struct = array ();
	foreach ( $keys as $k ) {
		$struct [$k] = find_key ( $html, $k );
	}
	return $struct;
}
// phan tich cau truc pattern
function analyze_string_struct($str) {
	global $keys;
	global $element_container;
	$html = new simple_html_dom ();
	$html->load( $str );
	$element_container = $html->childNodes ( 0 )->tag;
	if ($html->childNodes ( 0 )->class != '')
		$element_container .= '[class="' . $html->childNodes ( 0 )->class . '"]';
	else 
	{
		if ($html->childNodes ( 0 )->id != '')
			$element_container .= '[id="' . $html->childNodes ( 0 )->id . '"]';
	}
	$struct = array ();
	foreach ( $keys as $k ) {
		$struct [$k] = find_key ( $html, $k );
	}
	return $struct;
}
// tach du lieu tu the leaf
function extract_data($data, $key) {
	global $keys_map;
	if ($keys_map [$key]) {
		foreach ( $keys_map [$key] as $i ) {
			$data = $data->childNodes ( $i );
			if (! $data)
				return "data dont match pattern";
		}
	} else {
		return 'invalid key map';
	}
	return $data->plaintext;
}
// tach link
function extract_link($data, $key) {
	global $keys_map;
	if ($keys_map [$key]) {
		foreach ( $keys_map [$key] as $i ) {
			$data = $data->childNodes ( $i );
			if (! $data)
				return "data dont match pattern";
		}
	} else {
		return 'invalid key map';
	}
	return $data->href;
}
// tach link tu the a, su dung base url
function extract_full_link($data, $key, $base_url = '') {
	global $keys_map;
	if ($keys_map [$key]) {
		foreach ( $keys_map [$key] as $i ) {
			$data = $data->childNodes ( $i );
			if (! $data)
				return "data dont match pattern";
		}
	} else {
		return 'invalid key map';
	}
	return $base_url . $data->href;
}
// de quy => lay tat ca cac value trong mot node
function get_all_node_data($node) {
	$count = count ( $node->childNodes () );
	$data = array ();
	for($i = 0; $i < $count; $i ++) {
		if (! $node->childNodes ( $i )->childNodes ()) {
			if (trim ( $node->childNodes ( $i )->plaintext ) != '')
				$data [] = $node->childNodes ( $i )->plaintext;
		} else {
			$data = array_merge ( $data, get_all_node_data ( $node->childNodes ( $i ) ) );
		}
	}
	return $data;
}
// tach du lieu co dang liet ke
function extract_list($data, $key) {
	global $keys_map;
	if ($keys_map [$key]) {
		foreach ( $keys_map [$key] as $i ) {
			$data = $data->childNodes ( $i );
			if (! $data)
				return "data dont match pattern";
		}
	} else {
		return 'invalid key map';
	}
	return get_all_node_data ( $data );
}

function get_job_from_url($page_url, $element) {
	try {
		$content = curl_download ( $page_url );
		$doc = new simple_html_dom ();
		$doc->load ( $content );
		return $doc->find ( $element );
	} catch ( Exception $oe ) {
		echo $oe->getMessage ();
	}
	return null;
}

?>