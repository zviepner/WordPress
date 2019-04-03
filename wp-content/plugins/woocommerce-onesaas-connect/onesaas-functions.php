<?php

function os_init() {
	// Global parameters
	global $ProdId, $PageSize, $wpdb, $OrderCreatedTime, $LastUpdatedTime, $Page, $Action, $xml, $xmlRequest;
	//$PageSize = 100;
	// Initialise XML Response
	$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><OneSaas></OneSaas>');	
	$xml->addAttribute('Version', '3.0.0.2');
	readParameters();
	sendHeaders();
}

function readParameters() {
	global $PageSize, $ProdId, $wpdb, $OrderCreatedTime, $LastUpdatedTime, $Page, $Action, $xml, $xmlRequest;
	
	// Subtracting 86400 s from Unix timestamp (1 day) just to ensure we are not missing anything.  The time could be based on local server time rather than UTC
	$LastUpdatedTime = ((isset($_GET['LastUpdatedTime']) && (strtotime($_GET['LastUpdatedTime'].'UTC')>0)) ? (strtotime($_GET['LastUpdatedTime'].'UTC')) : strtotime('1970-01-19T00:00:00+00:00UCT'));
	$OrderCreatedTime = ((isset($_GET['OrderCreatedTime']) && (strtotime($_GET['OrderCreatedTime'].'UTC')>0)) ? (strtotime($_GET['OrderCreatedTime'].'UTC')) : strtotime('1970-01-19T00:00:00+00:00UCT'));
	$Page = ((isset($_GET['Page']) && (is_numeric($_GET['Page']))) ? (int) $_GET['Page'] : 0);
	$PageSize = ((isset($_GET['PageSize']) && (is_numeric($_GET['PageSize']))) ? (int) $_GET['PageSize'] : 100);
	$Action = (isset($_GET['Action']) ? $_GET['Action'] : '');
	$ProdId = ((isset($_GET['Id']) && (is_numeric($_GET['Id']))) ? (int) $_GET['Id'] : NULL);
	// Parse posted xml
	if ((file_get_contents("php://input") != null) && (file_get_contents("php://input") != ""))
		$xmlRequest = new SimpleXmlElement(file_get_contents("php://input"));
}

function sendHeaders() {
	header('Content-type: application/xml', true);
	header('Pragma: public', true);
	header('Cache-control: private', true);
	header('Expires: -1', true);
}

function verifyApiKey() {
	$dbkey = get_option('wc-onesaas-apikey');
	
	if($dbkey){
		$getKey = $_GET['AccessKey'];
		if($dbkey === $getKey){
			return true;
		}
	}
	return false;
}
/*
function loadField($id, $fieldCode){
	global $wpdb;
	$tableName = $wpdb->prefix.'wpsc_submited_form_data';
	$query = "SELECT value FROM $tableName WHERE log_id = $id AND form_id = '$fieldCode'";
	$rows = $wpdb->get_row($query);
	return htmlspecialchars(strip_tags($rows->value));
}
*/
function getProductCode($product) {
	if ($product==null) {
		return null;
	}
	return ($product->get_sku()==null)?$product->id:$product->get_sku();
}

function xml_adopt($root, $new) {
    $node = $root->addChild($new->getName(), (string) $new);
    foreach($new->attributes() as $attr => $value) {
        $node->addAttribute($attr, $value);
    }
    foreach($new->children() as $ch) {
        xml_adopt($node, $ch);
    }
}

function checkCreateTable() {
	global $wpdb;
		$collate = '';
	if ($wpdb->has_cap('collation')) {
		if(!empty($wpdb->charset))
			$collate .= "DEFAULT CHARACTER SET $wpdb->charset";
		if(!empty($wpdb->collate ) )
			$collate .= " COLLATE $wpdb->collate";
	}
	$sql = "
	CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "osapi_last_modified (
		object_type ENUM('customer') NOT NULL, 
		id bigint(20) NOT NULL, 
		hash VARCHAR(255) not null, 
		last_modified_before DATETIME NOT NULL, 
		PRIMARY KEY(object_type, id)
	) $collate;";

	$wpdb->query($sql);
}

function parseSingleStockUpdateRequest (SimpleXmlElement $aRequest) {
	$stockUpdateRequest = array();
	if (!is_null($aRequest) && $aRequest->getName()==='ProductStockUpdate') {
		foreach ($aRequest->attributes() as $attr) {
			if ($attr->getName() === 'Id') {
				$stockUpdateRequest['ProductCode'] = 0 + $attr;
			}
		}
		foreach ($aRequest->children() as $child) {
			switch ($child->getName()) {
				case 'StockAtHand':
					$stockUpdateRequest['StockAtHand'] = $child;
					break;
				case 'StockAllocated':
					$stockUpdateRequest['StockAllocated'] = $child;
					break;
				case 'StockAvailable':
					$stockUpdateRequest['StockAvailable'] = (int) $child;
					break;
				default:
					// Not interested
					break;
			}
		}
		$stockUpdateRequest;
	}
	return $stockUpdateRequest;
}

function xml_entities($string) {
    return strtr(
        $string, 
        array(
            "<" => "&lt;",
            ">" => "&gt;",
            '"' => "&quot;",
            "'" => "&apos;",
            "&" => "&amp;",
        )
    );
}
function get_rate_percent( $key_or_rate ) {
    global $wpdb;

    if ( is_object( $key_or_rate ) ) {
      $key      = $key_or_rate->tax_rate_id;
      $tax_rate = $key_or_rate->tax_rate;
    } else {
      $key      = $key_or_rate;
      $tax_rate = $wpdb->get_var( $wpdb->prepare( "SELECT tax_rate FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_id = %s", $key ) );
    }

    return apply_filters( 'woocommerce_rate_percent', floatval( $tax_rate ) , $key );
}

function get_variations($product) {
		$available_variations = array();

		foreach ( $product->get_children() as $child_id ) {
			$variation = wc_get_product( $child_id );

			// Filter 'woocommerce_hide_invisible_variations' to optionally hide invisible variations (disabled variations and variations with empty price)
			if ( apply_filters( 'woocommerce_hide_invisible_variations', false, $product->get_id(), $variation ) && ! $variation->variation_is_visible() ) {
				continue;
			}

			$available_variations[] = apply_filters( 'woocommerce_available_variation', array(
					'variation_id'=> $variation->get_id()
			), $product, $variation );
			}			
		return $available_variations;
	}

function item_subtotal( $item, $inc_tax = false, $round = true ) {
        if ( $inc_tax ) {
            $price = ( $item['line_subtotal'] + $item['line_subtotal_tax'] ) / max( 1, $item['qty'] );
        } else {
            $price = ( $item['line_subtotal'] / max( 1, $item['qty'] ) );
        }

        $price = $round ? number_format( (float) $price, wc_get_price_decimals(), '.', '' ) : $price;

        return apply_filters( 'woocommerce_order_amount_item_subtotal', $price, $item, $inc_tax, $round );
    }
	
function item_total( $item, $inc_tax = false, $round = true ) {

        $qty = ( ! empty( $item['qty'] ) ) ? $item['qty'] : 1;

        if ( $inc_tax ) {
            $price = ( $item['line_total'] + $item['line_tax'] ) / max( 1, $qty );
        } else {
            $price = $item['line_total'] / max( 1, $qty );
        }

        $price = $round ? round( $price, wc_get_price_decimals() ) : $price;

        return apply_filters( 'woocommerce_order_amount_item_total', $price, $item, $inc_tax, $round );
    }
?>
