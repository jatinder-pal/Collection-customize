<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{     $collections = $shopify('GET /admin/custom_collections.json');
		if($collections){
		echo '<form method="post" name="form" id="getproducts" action="#">';
		echo '<table cellspacing="10" cellpadding="10" border="1">';
		echo '<thead><tr><th></th><th>Collection Name</th><th>Image</th><th>Content</th><th>Add Content</th></tr></thead>';
			echo '<tbody>';
		foreach($collections as $Allcollections)
		
		{
			echo '<tr>';
			echo '<td><input id="collectiondataid" type="checkbox" name="product_ids[id]" value="'.$Allcollections["id"].'" data-pro-handle="'.$Allcollections["handle"].'" /></td>';
			echo '<td>'.$Allcollections['title'].'</td>';
			echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" /></td>';
			echo '<td>'.$Allcollections['body_html'].'</td>';
			echo '<td>'.'<textarea class="form-control" id="metafield1-text"></textarea>'.'</td>';
			echo '<td>'.'<textarea class="form-control" id="metafield2-text"></textarea>'.'</td>';
			echo '<td>'.'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Metafield</button>'.'</td>';
			echo '</tr>';
			
			}
		echo '<tr><td colspan="5"><input type="button" class="saveproducts" value="Button" name="submit" /></td></tr></tbody>';
		echo '</table>';
	 echo '</form>';
	
	}
	else{
	echo "<div class='no-result'>No collections</div>";
	}
			
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
