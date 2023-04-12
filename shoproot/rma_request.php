<?php
/* -----------------------------------------------------------------------------------------
   MODUL:				RMA-Modul fuer modified eCommerce Shopsoftware
   Description:			Verwaltung von Kundenreklamationen
   Shopversion:			modified-2.0.7.2 (ff)
   PHP:					max. PHP 8.1
--------------------------------------------------------------------------------------------
   C R E D I T S
--------------------------------------------------------------------------------------------
   Ersteller:			Southbridge.de, 31.01.2006
   Adaption 1.0x:		lolly, 14.12.2009
   Weiterentwicklung:	wulfy, 11.03.2013
   Korrekturen:			ralph_84, 26.03.2013 + 01.04.2013 / bonsai, 20.10.2016
   Anpassung 2.0.7.x:	awids, 09.04.2023
--------------------------------------------------------------------------------------------
   License:				Released under the GNU General Public License 2
------------------------------------------------------------------------------------------*/

include ('includes/application_top.php');

// include needed functions
require_once(DIR_FS_INC.'sb_get_reasons.inc.php');
require_once(DIR_FS_INC.'sb_get_rma_products.inc.php');
require_once(DIR_FS_INC . 'xtc_draw_pull_down_menu.inc.php');

if(!isset($_SESSION['customer_id'])){
	xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
}	

// create smarty elements
$smarty = new Smarty;

require(DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/source/boxes.php');
$breadcrumb->add(NAVBAR_TITLE_RMA_REQUEST, xtc_href_link(FILENAME_RMA_REQUEST, '', 'SSL'));
require(DIR_WS_INCLUDES.'header.php');

// Modul aktivieren	
if (defined('MODULE_MODIFIED_RMA_STATUS') && MODULE_MODIFIED_RMA_STATUS == 'true') {
	
		$process = false;
	
		if (isset ($_POST['action']) && ($_POST['action'] == 'process')) {
			$process = true;
			
			$cust_id = xtc_db_prepare_input($_SESSION['customer_id']);
		  	$orderid = xtc_db_prepare_input($_POST['order_id']);
		  	$products_id = xtc_db_prepare_input($_POST['products_id']);
			$products_ean = xtc_db_prepare_input($_POST['products_ean']);
		  
			$error_msg = xtc_db_prepare_input($_POST['error_msg']);
			$error_msg = strip_tags($error_msg);
		  
			$reason = xtc_db_prepare_input($_POST['reason_id']);
			$sql_fields = " ";
			$sql_values = " ";
			
			$error = false;
		
			if(MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION == 'true') {
				if($products_id == '0'){
		      $error = true;
		      $messageStack->add('orders', ENTRY_RMA_PRODUCTS);
		    }
		}
		
		if(MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW == 'true') {	
			if ($error_msg == '') {
				$error = true;
				$messageStack->add('orders', ENTRY_RMA_ERROR_MESSAGE);
			}
			if (strlen($error_msg) < MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH) {
				$error = true;
				$messageStack->add('orders', ENTRY_RMA_ERROR_MESSAGE_LENGTH);
			}		
		}
			
		if (MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW == 'true') {
			if (MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION == 'true' && $products_ean == '') {
				$error = true;
				$messageStack->add('orders', ENTRY_RMA_PRODUCTS_EAN);
			}		
		}
	
		if (MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION == 'true') {
			if ($reason == '0') {
				$error = true;
				$messageStack->add('orders', ENTRY_RMA_REASON);
			}
		}
	
		if (xtc_db_prepare_input($_POST['pickup'])) {
			$sql_fields .= " , pickup ";
			$sql_values .= " , " . xtc_db_prepare_input($_POST['pickup']) . " ";
		}
		
		if (xtc_db_prepare_input($_POST['cost_estimate'])) {
			$sql_fields .= " , cost_estimate ";
			$sql_values .= " , " . xtc_db_prepare_input($_POST['cost_estimate']) . " ";
		}	
	  
		if (xtc_db_prepare_input($_POST['shipping_time'])) {
			$sql_fields .= " , shipping_time ";
			$sql_values .= " ,  '" . xtc_db_prepare_input($_POST['shipping_time']) . "' ";
		}
		
		if($error == false) {
			xtc_db_query("INSERT INTO " . TABLE_RMA . " (customers_id, orders_id, products_id, products_ean, reason_id, description, rma_date " . $sql_fields .  ") VALUES (" . $cust_id . "," . $orderid . "," . $products_id . ",'".$products_ean."', '".$reason."','" . $error_msg . "', now() " . $sql_values.")");
			$customers_query = xtc_db_query("SELECT customers_firstname,customers_lastname,customers_email_address FROM ".TABLE_CUSTOMERS." WHERE customers_id = '".$cust_id."'");
	    	$customers = xtc_db_fetch_array($customers_query);
	
		    $product_query = xtc_db_query("SELECT products_name FROM ".TABLE_PRODUCTS_DESCRIPTION." WHERE products_id = '".$products_id."' AND language_id = '".$_SESSION['languages_id']."'");
		    $product = xtc_db_fetch_array($product_query);
			
			$customers_name = $customers['customers_firstname'].' '.$customers['customers_lastname'];
	
			$smarty->assign('tpl_path', HTTP_SERVER.DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/');
			$smarty->assign('CUSTOMER_ID', $cust_id);
		    $smarty->assign('CUSTOMER_NAME', $customers_name);
		    $smarty->assign('CUSTOMER_EMAIL', $customers['customers_email_address']);
		    $smarty->assign('CUSTOMER_ORDER_ID', $orderid);
		    $smarty->assign('CUSTOMER_ORDER_PRODUCT_ID', $products_id);
		    $smarty->assign('CUSTOMER_ORDER_PRODUCT_NAME', $product['products_name']);
		    $smarty->assign('CUSTOMER_REASON', sb_get_reason($reason));
		    $smarty->assign('CUSTOMER_ERROR', $error_msg);
					
			$html_mail = $smarty->fetch(CURRENT_TEMPLATE.'/admin/mail/'.$_SESSION['language'].'/new_rma_mail.html');
			$txt_mail = $smarty->fetch(CURRENT_TEMPLATE.'/admin/mail/'.$_SESSION['language'].'/new_rma_mail.txt');
	
			xtc_php_mail(EMAIL_BILLING_ADDRESS, EMAIL_BILLING_NAME, STORE_OWNER_EMAIL_ADDRESS, $customers_name, '', EMAIL_BILLING_REPLY_ADDRESS, EMAIL_BILLING_REPLY_ADDRESS_NAME, '', '', 'RMA', $html_mail, $txt_mail);
	    
		    $smarty->assign('success', '1');
			$smarty->assign('RMA_OVERVIEW', '<a href="'.xtc_href_link(FILENAME_RMA_OVERVIEW).'">'.RMA_OVERVIEW_TEXT.'</a>');
		}
	}   
	  
	if($messageStack->size('orders') > 0) {
		$smarty->assign('error', $messageStack->output('orders'));
	}

	if (isset($_SESSION['customer_id'])) {
		$smarty->assign('language', $_SESSION['language']);
		$order_id = xtc_db_prepare_input($_POST['order_id']);
	
		$smarty->assign('FORM_ACTION', xtc_draw_form('orders', xtc_href_link(FILENAME_RMA_REQUEST, '', 'SSL'), 'post', 'onsubmit="return check_form(orders);"').xtc_draw_hidden_field('action', 'process'));
		$smarty->assign('ORDER_ID', xtc_draw_hidden_field('order_id', $order_id ));
		$smarty->assign('CHOOSE_PRODUCTS_ID', sb_get_rma_products($order_id, array('name'=>'products_id','text'=> '&nbsp;' . (MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION == 'true' ? '':'')), '', ''));
	
		$smarty->assign('CHOOSE_REASON', sb_get_rma_reasons(array('name'=>'reason_id','text'=> '&nbsp;' . (MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION == 'true' ? '':'')), '', ''));
		
		if (MODULE_MODIFIED_RMA_PICK_UP_SHOW == 'true') {
			$smarty->assign('PICK_UP', '1');
			$smarty->assign('PICK_UP_YES', xtc_draw_radio_field('pickup', '1' ));
			$smarty->assign('PICK_UP_NO', xtc_draw_radio_field('pickup', '0', 'checked="checked"' ));
		}
		
		if (MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW == 'true') {	
			$smarty->assign('COST_ESTIMATE', '1');
			$smarty->assign('COST_ESTIMATE_YES', xtc_draw_radio_field('cost_estimate', '1' ));
			$smarty->assign('COST_ESTIMATE_NO', xtc_draw_radio_field('cost_estimate', '0', 'checked="checked"' ));	
		}
		
		$smarty->assign('SHIPPING_TIME', xtc_draw_input_field('shipping_time', '', 'placeholder="(TT.MM.JJJJ)"'));
		$smarty->assign('BUTTON_SUBMIT', xtc_image_submit('button_send.gif', IMAGE_BUTTON_SEND));
	    $smarty->assign('BUTTON_BACK', '<a href="'.xtc_href_link(FILENAME_RMA_OVERVIEW, '', 'SSL').'">'.xtc_image_button('button_back.gif', IMAGE_BUTTON_BACK).'</a>');
		$smarty->assign('FORM_END', '</form>');
	
		if (MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW == 'true') {	
			$smarty->assign('ERROR_MESSAGE', xtc_draw_textarea_field('error_msg', 'soft', 84, 5));
		}
		
		$smarty->assign('EAN', xtc_draw_input_field('products_ean', '', ''));
		if (MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW == 'true') {
			$smarty->assign('ADD_EAN', '<span class="inputRequirement">*</span>');
		}
		
		$main_content = $smarty->fetch(CURRENT_TEMPLATE.'/module/rma_request.html');
		$smarty->assign('main_content', $main_content);
	}
	
}

$smarty->assign('language', $_SESSION['language']);
$smarty->caching = 0;

if (!defined('RM')) $smarty->load_filter('output', 'note');
$smarty->display(CURRENT_TEMPLATE.'/index.html');  
include ('includes/application_bottom.php');

?>