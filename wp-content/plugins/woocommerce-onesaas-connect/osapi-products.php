<?php
/*
  osapi-contacts.php
  OneSaas Connect API 3.0.0.2 for WooCommerce v3.0.00
  http://www.onesaas.com
  Copyright (c) 2014 oneSaas
*/

function addProducts() {
	global $PageSize, $wpdb, $OrderCreatedTime, $LastUpdatedTime, $Page, $Action, $xml;

	$filters = array( 
		'post_type' => 'product', 
		'posts_per_page' => $PageSize,
		'paged' => $Page+1,
		'orderby' =>'modified',
		'order' => 'DESC'
	);
    $loop = new WP_Query( $filters );

    while ( $loop->have_posts() ) {
		$loop->the_post();
		global $product;
		
		$lastModified = strtotime($product->get_date_modified());
		if ($lastModified<$LastUpdatedTime) {
			break;
		}
		
		$product_xml = $xml->AddChild('Product');
		$product_xml->AddAttribute('Id', $product->get_id());
		$product_xml->AddAttribute('LastUpdated', $product->get_date_modified());
		$product_xml->AddAttribute('IsDeleted', 'false');
		$product_xml->Code = getProductCode($product);
		$product_xml->Name = xml_entities($product->get_name());
		$product_xml->Description = xml_entities(strip_tags($product->get_description()));
		$product_xml->IsActive = 'true';
		$product_xml->Url = admin_url() . 'post.php?post=' . $product->get_id() . '&action=edit';
		$product_xml->PublicUrl = get_permalink($product->get_id());
		$product_xml->IsInventoried = ($product->get_manage_stock()=='1')?'true':'false';
		$product_xml->StockAtHand = $product->get_manage_stock()?$product->get_stock_quantity():null;
		$product_xml->SalePrice = $product->get_price();
		$weight = $product_xml->addChild('Weight', $product->get_weight());
		$weight->AddAttribute('unit', 'kg');
		// Dimensions
		$dimensions = wc_format_dimensions( $product->get_dimensions( false ) );
		if (($dimensions != null) && ($dimensions != '')) {
			$dimensions_array = explode( ' x ', $dimensions );
			if (($dimensions_array!=null) && (is_array($dimensions_array)) && (sizeof($dimensions_array)==3)) {
				$length = $product_xml->addChild('Length', $dimensions_array[0]);
				$width = $product_xml->addChild('Width', $dimensions_array[1]);
				$height = $product_xml->addChild('Height', substr($dimensions_array[2],0,strpos($dimensions_array[2],' ')));
				$unit = substr($dimensions_array[2],strpos($dimensions_array[2],' ')+1);
				$length->AddAttribute('unit', $unit);
				$width->AddAttribute('unit', $unit);
				$height->AddAttribute('unit', $unit);
			}
		}
		$product_xml->Tags = strip_tags(wc_get_product_tag_list($product->get_id()));
		$product_xml->Type = 'Product';
		$cats = get_the_terms( $product->get_id(), 'product_cat' );
		if(!empty($cats))
		{
		$categories_xml = $product_xml->AddChild('Categories');
			foreach ($cats as $cat) {	
				$product_cat_id = $cat->term_id;
				$category_xml = $categories_xml->AddChild('Category');
				if($cat->parent == 0)
				{
					$category_xml->ID = $product_cat_id;
					$category_xml->Name = $cat->name;			
				}
				else
				{
					$category_xml->ID = $product_cat_id;
					$category_xml->ParentID = $cat->parent;
					$category_xml->Name = $cat->name;
				}
			}
		}
		if ($product->is_type('grouped')) {
			$product_xml->Type = 'Combo';
			$combo_items_xml = $product_xml->AddChild('ComboItems');
			foreach ($product->get_children() as $combo_item_id) {
				$combo_item_xml = $combo_items_xml->addChild('ComboItem');
				$combo_item_xml->ProductId = $combo_item_id;
				$combo_item_xml->Quantity = 1;
			}
		}
		if ($product->is_type('variable')) {
			$masterCode = getProductCode($product);	
			$variations = get_variations($product);
			//var_dump($variations);
			foreach($variations as $variation_id) {
				$variation_xml = $xml->AddChild('Product');
				$variation = new WC_Product_Variation($variation_id['variation_id']);
				$variationCode = getProductCode($variation);
				$variation_xml->AddAttribute('Id', $variation->get_id());
				$variation_xml->AddAttribute('LastUpdated', $variation->get_date_modified());
				$variation_xml->AddAttribute('IsDeleted', 'false');	
				// Variations have the same sku as master.  Adding id to differentiate, Otherwise leave variation SKU
				if($masterCode !==  $variationCode)
				{
					$variation_xml->Code = $variationCode;
				}
				else
				{
					$variation_xml->Code = $variationCode . '-' . $variation_id['variation_id'];	
				}	
				$variation_xml->MasterCode = $masterCode;
				$variation_xml->Name = xml_entities($variation->get_name());
				$variation_xml->Description = xml_entities(strip_tags($variation->get_description()));
				$variation_xml->IsActive = ($variation->variation_is_active()=='1')?'true':'false';
				$variation_xml->Url = admin_url() . 'post.php?post=' . $variation->get_id() . '&action=edit';
				$variation_xml->PublicUrl = get_permalink($variation->get_id());
				$variation_xml->IsInventoried = ($variation->get_manage_stock()=='1')?'true':'false';
				$variation_xml->StockAtHand = $variation->get_manage_stock()?$variation->get_stock_quantity():null;
				$variation_xml->SalePrice = $variation->get_price();//$variation['price_html'];
				$weight = $variation_xml->addChild('Weight', $variation->get_weight());
				$weight->AddAttribute('unit', 'kg');
				// Dimensions
				$dimensions = wc_format_dimensions( $variation->get_dimensions( false ) );
				
				if (($dimensions != null) && ($dimensions != '')) {
					$dimensions_array = explode( ' x ', $dimensions );
					if (($dimensions_array!=null) && (is_array($dimensions_array)) && (sizeof($dimensions_array)==3)) {
						$length = $variation_xml->addChild('Length', $dimensions_array[0]);
						$width = $variation_xml->addChild('Width', $dimensions_array[1]);
						$height = $variation_xml->addChild('Height', substr($dimensions_array[2],0,strpos($dimensions_array[2],' ')));
						$unit = substr($dimensions_array[2],strpos($dimensions_array[2],' ')+1);
						$length->AddAttribute('unit', $unit);
						$width->AddAttribute('unit', $unit);
						$height->AddAttribute('unit', $unit);
					}
				}
				$variation_xml->Type = 'Product';
				$options = $variation_xml->AddChild('Options');
				$var_attributes = $variation->get_variation_attributes();
				if (($var_attributes != null) && is_array($var_attributes)) {
					foreach ($var_attributes as $attribute_name => $attribute_value) {
						$option = $options->AddChild('Option');
						$option->Name = htmlspecialchars(substr($attribute_name,10));
						$option->Value = htmlspecialchars($attribute_value);
					}
				}
				$cats = get_the_terms( $variation->get_id(), 'product_cat' );				
				if(!empty($cats))
				{	
				$categories_xml = $variation_xml->AddChild('Categories');				
					foreach ($cats as $cat) {	
						$product_cat_id = $cat->term_id;
						$category_xml = $categories_xml->AddChild('Category');
						if($cat->parent == 0)
						{
							$category_xml->ID = $product_cat_id;
							$category_xml->Name = $cat->name;			
						}
						else
						{
							$category_xml->ID = $product_cat_id;
							$category_xml->ParentID = $cat->parent;
							$category_xml->Name = $cat->name;
						}
					}
				}
				//Additional Custom Fields
				$prod_meta = get_post_meta($variation->get_id());
				foreach($prod_meta as $custom_meta => $custom_meta_value){
					 if($custom_meta[0] == '_')
					 {
						//Skip the meta_keys that start with _
						continue;
					 }
					 else
					{
						$custom_meta_value = implode(',',$custom_meta_value);
						$sanitized_value = xml_entities($custom_meta_value);
						$customfield_xml = $variation_xml->AddChild('CustomField', $sanitized_value);
						$customfield_xml->AddAttribute('Name',$custom_meta);
					 }
				}				
			}
		}		
		
		//Additional Custom Fields
		$prod_meta = get_post_meta($product->get_id());
		foreach($prod_meta as $custom_meta => $custom_meta_value){
			 if($custom_meta[0] == '_')
			 {
				//Skip the meta_keys that start with _
				continue;
			 }
			 else
			{
				$custom_meta_value = implode(',',$custom_meta_value);
				$sanitized_value = xml_entities($custom_meta_value);
				$customfield_xml = $product_xml->AddChild('CustomField', $sanitized_value);
				$customfield_xml->AddAttribute('Name',$custom_meta);
			}
		}			
	}
    wp_reset_query(); 
}
?>
