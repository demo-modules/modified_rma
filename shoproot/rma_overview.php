<?php
/* -----------------------------------------------------------------------------------------
   MODUL:			RMA-Modul fuer modified eCommerce Shopsoftware
   Description:			Verwaltung von Kundenreklamationen
   Shopversion:			modified-2.0.7.2 (ff)
   PHP:				max. PHP 8.1
--------------------------------------------------------------------------------------------
   C R E D I T S
--------------------------------------------------------------------------------------------
   Ersteller:			Southbridge.de, 31.01.2006
   Adaption 1.0x:		lolly, 14.12.2009
   Weiterentwicklung:		wulfy, 11.03.2013
   Korrekturen:			ralph_84, 26.03.2013 + 01.04.2013 / bonsai, 20.10.2016
   Anpassung 2.0.7.x:		awids, 09.04.2023
--------------------------------------------------------------------------------------------
   License:			Released under the GNU General Public License 2
------------------------------------------------------------------------------------------*/

include('includes/application_top.php');

// include needed functions
require_once(DIR_FS_INC.'sb_get_rma_status.inc.php');
require_once(DIR_FS_INC.'xtc_date_short.inc.php');

if (!isset($_SESSION['customer_id'])) {
	xtc_redirect(xtc_href_link(FILENAME_LOGIN, '', 'SSL'));
}

$smarty = new Smarty;
require (DIR_FS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/source/boxes.php');

require_once(DIR_FS_INC.'xtc_draw_pull_down_menu.inc.php');
$breadcrumb->add(NAVBAR_TITLE_RMA_OVERVIEW, xtc_href_link(FILENAME_RMA_OVERVIEW, '', 'SSL'));

require (DIR_WS_INCLUDES.'header.php');

if (defined('MODULE_MODIFIED_RMA_STATUS') && MODULE_MODIFIED_RMA_STATUS == 'true') {

	if(isset($_SESSION['customer_id'])){
		$smarty->assign('language', $_SESSION['language']);
		$orders_query = xtc_db_query("SELECT orders_id, DATE_FORMAT(date_purchased , '%d.%m.%Y') AS DATE FROM ".TABLE_ORDERS." WHERE customers_id = '".(int) $_SESSION['customer_id']."' ORDER BY orders_id DESC");
	
		while ($orders = xtc_db_fetch_array($orders_query)) {
			$order_ids[] = array(
				'id' => $orders['orders_id'],
				'text' => 'BID-'.$orders['orders_id'] . RMA_TEXT_FROM . $orders['DATE']);
		}
	
		$smarty->assign('FORM_ACTION', xtc_draw_form('orders', xtc_href_link(FILENAME_RMA_REQUEST, '', 'SSL'), 'post'));
		$smarty->assign('CHOOSE_ORDER_ID', xtc_draw_pull_down_menu('order_id', $order_ids, '', ''));
		$smarty->assign('BUTTON_SUBMIT', xtc_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE));
		$smarty->assign('FORM_END', '</form>');
	
		$rma_overview_array = array();
		$rma_query = xtc_db_query("SELECT rma_id, rma_date, rma_status_id FROM ".TABLE_RMA." WHERE customers_id = '".(int)$_SESSION['customer_id']."' ORDER BY rma_id DESC");
		
		while($rma_overview = xtc_db_fetch_array($rma_query)){
		
			$rma_overview_array[] = array(
				'RMA_ID' 		=> $rma_overview['rma_id'],
				'RMA_DATE' 		=> xtc_date_short($rma_overview['rma_date']),
				'RMA_STATUS' 	=> sb_get_status($rma_overview['rma_status_id']),
				'RMA_ACTION' 	=> '<a href="'.xtc_href_link(FILENAME_RMA_REQUEST, 'rma_id='.$rma_overview['rma_id'], 'SSL').'">'.RMA_TEXT_SHOW.'</a>');
		}
		$smarty->assign('rma_content', $rma_overview_array);
		
	}
	$main_content = $smarty->fetch(CURRENT_TEMPLATE.'/module/rma_overview.html');
	$smarty->assign('main_content', $main_content);	
}	

$smarty->caching = 0;
$smarty->assign('language', $_SESSION['language']);

if (!defined('RM')) $smarty->load_filter('output', 'note');
$smarty->display(CURRENT_TEMPLATE.'/index.html'); 
include ('includes/application_bottom.php');
?>
