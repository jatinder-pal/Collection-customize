<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
echo $collectionid = $_REQUEST['collectionid'];
echo $meta1 = $_REQUEST[' meta1'];
echo $meta2 = $_REQUEST[' meta2'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	if($meta1)
	{
	$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'lowerData', 'value' => $meta1,
	'value_type' => 'string'));
	} 
	else {
	$meta1 = "noData";
	$metafield = array( "metafield" => array('namespace' => 'revisebutton', 'key' => 'lowerData', 'value' => $meta1,
	'value_type' => 'string'));
	}
	
	$auto_manual_field = array( "metafield" => array('namespace' => 'automanualfield', 'key' => 'automanual', 'value' => $auto_manual,
	'value_type' => 'string'));	
	$response = $shopify('POST /admin/collections/' + $collectionid + '/metafields.json',$metafield);	
	$response_auto_manual = $shopify('POST /admin/collections/' + $collectionid + '/metafields.json',$auto_manual_field);
	echo $response['value'].'==='.$response_auto_manual['value'];
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
