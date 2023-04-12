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

	switch ($action) {
		case 'new_reason':
			$count_reason_id = xtc_db_query("SELECT MAX(rma_reason_id) AS IDENTITY FROM ".TABLE_RMA_REASON);
			$count_reason = xtc_db_fetch_array($count_reason_id);
			$next_reason_id = $count_reason['IDENTITY'];
			if ($next_reason_id != 0 ? $next_reason_id +=1 : $next_reason_id = 1);
			for ($i = 0; $i < $lang; $i++) {
				$languages_id = $languages[$i]['id'];
				
				if ($_POST['rma_reason_name'][$languages_id] != '') {
					$reason_array = array(
						'rma_reason_id' 	=> $next_reason_id,
						'language_id' 		=> $languages_id,
						'rma_reason_name'	=> xtc_db_prepare_input($_POST['rma_reason_name'][$languages_id]));
					xtc_db_perform(TABLE_RMA_REASON, $reason_array);
				}
			}
			xtc_redirect(xtc_href_link(FILENAME_RMA, 'action=change_reason', 'SSL'));
			break;	
		case 'change_reason_update':
			$ids = count($_POST['rma_reason_id']);
			$delete_ids = ((isset($_POST['delete']) && is_countable($_POST['delete']) && count($_POST['delete']) > 0) ? count($_POST['delete']) : 0);
			if (isset($_POST['delete'])) {
				for($b = 0; $b < $delete_ids; $b++){
					$delete_array = $_POST['delete'][$b];
					xtc_db_query("DELETE FROM ".TABLE_RMA_REASON." WHERE rma_reason_id 	= '".$delete_array."'");
				}
			} elseif (isset($_POST['rma_reason_id'])) {
				
				for ($b = 0; $b < $ids; $b++) {
					$reason_id = $_POST['rma_reason_id'][$b];
					
					for ($i = 0; $i < $lang; $i++) {
						$languages_id = $languages[$i]['id'];
						xtc_db_query("UPDATE ".TABLE_RMA_REASON." SET rma_reason_name = '".xtc_db_prepare_input($_POST['rma_reason_name'][$languages_id][$reason_id])."' WHERE rma_reason_id = '".$reason_id."' AND language_id = '".$languages_id."'");
					}
				}
			}
			xtc_redirect(xtc_href_link(FILENAME_RMA, 'action=change_reason', 'SSL'));
		    break;		
		case 'new_status':
			$count_status_id = xtc_db_query("SELECT MAX(rma_status_id) AS IDENTITY FROM ".TABLE_RMA_STATUS);
			$count_status = xtc_db_fetch_array($count_status_id);
			$next_status_id = $count_status['IDENTITY'];
			if ($next_status_id != 0 ? $next_status_id +=1 : $next_status_id = 1);
			for ($i = 0; $i < $lang; $i++) {
				$languages_id = $languages[$i]['id'];
				if($_POST['rma_status_name'][$languages_id] != '') {
					$status_array = array(
						'rma_status_id' 	=> $next_status_id,
						'language_id' 		=> $languages_id,
						'rma_status_name'	=> xtc_db_prepare_input($_POST['rma_status_name'][$languages_id]));
						
					xtc_db_perform(TABLE_RMA_STATUS, $status_array);
				}
			}
			xtc_redirect(xtc_href_link(FILENAME_RMA, 'action=change_status','SSL'));
		    break;
		case 'change_status_update':
			$ids = count($_POST['rma_status_id']);
			$delete_ids = ((isset($_POST['delete']) && is_countable($_POST['delete']) && count($_POST['delete']) > 0) ? count($_POST['delete']) : 0);
			if (isset($_POST['delete'])) {
				for ($b = 0; $b < $delete_ids; $b++) {
					$delete_array = $_POST['delete'][$b];
					xtc_db_query("DELETE FROM ".TABLE_RMA_STATUS." WHERE rma_status_id = '".$delete_array."'");
				}
			} elseif (isset($_POST['rma_status_id'])) {
				for ($b = 0; $b < $ids; $b++) {
					$status_id = $_POST['rma_status_id'][$b];
					for ($i = 0; $i < $lang; $i++) {
						$languages_id = $languages[$i]['id'];
						xtc_db_query("UPDATE ".TABLE_RMA_STATUS." SET rma_status_name = '".xtc_db_prepare_input($_POST['rma_status_name'][$languages_id][$status_id])."' WHERE rma_status_id = '".$status_id."' AND language_id = '".$languages_id."'");
					} 
				}
			}
			xtc_redirect(xtc_href_link(FILENAME_RMA, 'action=change_status','SSL'));
			break;
		case 'change':
			if ($_POST['rma_action'] == 1) {
				$anz = count($_POST['status']);
				for ($i = 0; $i < $anz; $i++) {
					xtc_db_query("DELETE FROM ".TABLE_RMA." WHERE rma_id = '".$_POST['status'][$i]."'");
					xtc_db_query("DELETE FROM ".TABLE_RMA_COMMENTS." WHERE rma_id = '".$_POST['status'][$i]."'");
				}
			}
			xtc_redirect(xtc_href_link(FILENAME_RMA,'','SSL'));
			break;
		case 'newrma_insert':
			$customers_id = xtc_db_prepare_input($_POST['customers_id']);
			$orders_id = xtc_db_prepare_input($_POST['orders_id']);
			$products_id = xtc_db_prepare_input($_POST['products_id']);
			$products_ean = xtc_db_prepare_input($_POST['products_ean']);
			$reason_id = xtc_db_prepare_input($_POST['reason_id']);
			$shipping_time = xtc_db_prepare_input($_POST['shipping_time']);
			$pickup = xtc_db_prepare_input($_POST['pickup']);
			$cost_estimate = xtc_db_prepare_input($_POST['cost_estimate']);
			$comments = xtc_db_prepare_input($_POST['comments']);

			$order = new order($orders_id);
			$date_now = date("Y-m-d H:i:s");	
			
			$new_rma_array = array(
				'customers_id'	=> $customers_id,
				'orders_id' 	=> $orders_id,
				'products_id'	=> $products_id,	
				'products_ean' 	=> $products_ean,
				'reason_id'		=> $reason_id,
				'description' 	=> $_POST['description'],
				'rma_date'		=> $date_now,
				'pickup'		=> $pickup,
				'shipping_time'	=> $shipping_time,
				'rma_status_id' => (int)$_POST['status'],
				'cost_estimate' => $cost_estimate);
			xtc_db_perform(TABLE_RMA, $new_rma_array);
			
			$comments_array = array(
				'rma_id'		=> (int)$_POST['rma_id'],
				'rma_status_id' => (int)$_POST['status'],
				'comments' 		=> $comments,
				'edit_date'		=> $date_now);
			xtc_db_perform(TABLE_RMA_COMMENTS, $comments_array);
			
			if (isset($_POST['status'])) {
				$customers_query = xtc_db_query("SELECT customers_firstname, customers_lastname, customers_email_address FROM ".TABLE_CUSTOMERS." WHERE customers_id = '".$customers_id."'");
				$customers = xtc_db_fetch_array($customers_query);
				$customers_name = $customers['customers_firstname'].' '.$customers['customers_lastname'];

				if (isset($_POST['comments_send'])) {
					$smarty->assign('NOTIFY_COMMENTS', $comments);
				}

				$smarty->assign('tpl_path', HTTP_SERVER.DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/');
				$smarty->assign('RMA_STATUS', $rma_status_array[$_POST['status']]);
				$smarty->assign('NAME', $customers_name);
				
				if (isset($_POST['mail_send'])) {
					$html_mail = $smarty->fetch(CURRENT_TEMPLATE.'/admin/mail/'.$order->info['language'].'/change_rma_mail.html');
					$txt_mail = $smarty->fetch(CURRENT_TEMPLATE.'/admin/mail/'.$order->info['language'].'/change_rma_mail.txt');
					xtc_php_mail(EMAIL_BILLING_ADDRESS, EMAIL_BILLING_NAME, $customers['customers_email_address'], $customers_name, '', EMAIL_BILLING_REPLY_ADDRESS, EMAIL_BILLING_REPLY_ADDRESS_NAME, '', '', EMAIL_RMA_SUBJECT, $html_mail, $txt_mail);
				}
			}	
			xtc_redirect(xtc_href_link(FILENAME_RMA,'','SSL'));
			break;
		case 'update_rma':
			$comments = xtc_db_prepare_input($_POST['comments']);
			$customers_id = xtc_db_prepare_input($_POST['customers_id']);
			$order = new order($_POST['orders_id']);
			$date_now = date("Y-m-d H:i:s");	
			
			if (isset($_POST['status'])) {
				$customers_query = xtc_db_query("SELECT customers_firstname, customers_lastname, customers_email_address FROM ".TABLE_CUSTOMERS." WHERE customers_id = '".$customers_id."'");
				$customers = xtc_db_fetch_array($customers_query);
				$customers_name = $customers['customers_firstname'].' '.$customers['customers_lastname'];
		
				$comments_array = array(
					'rma_id'			=> (int)$_POST['rma_id'],
					'rma_status_id' 	=> (int)$_POST['status'],
					'comments' 			=> $comments,
					'edit_date'			=> $date_now);
				xtc_db_perform(TABLE_RMA_COMMENTS, $comments_array);
				
				xtc_db_query("UPDATE ".TABLE_RMA." SET rma_status_id 	= '".(int)$_POST['status']."' WHERE rma_id = '".(int)$_POST['rma_id']."'");
			
				if (isset($_POST['comments_send'])) {
					$smarty->assign('NOTIFY_COMMENTS', $comments);
				}

				$smarty->assign('tpl_path', HTTP_SERVER.DIR_WS_CATALOG.'templates/'.CURRENT_TEMPLATE.'/');
				$smarty->assign('RMA_STATUS', $rma_status_array[$_POST['status']]);
				$smarty->assign('NAME', $customers_name);
				
				if (isset($_POST['mail_send'])) {
					$html_mail = $smarty->fetch(CURRENT_TEMPLATE.'/admin/mail/'.$order->info['language'].'/change_rma_mail.html');
					$txt_mail = $smarty->fetch(CURRENT_TEMPLATE.'/admin/mail/'.$order->info['language'].'/change_rma_mail.txt');
					xtc_php_mail(EMAIL_BILLING_ADDRESS, 
								 EMAIL_BILLING_NAME, 
								 $customers['customers_email_address'], 
								 $customers_name, 
								 '', 
								 EMAIL_BILLING_REPLY_ADDRESS, 
								 EMAIL_BILLING_REPLY_ADDRESS_NAME, 
								 '', 
								 '', 
								 EMAIL_RMA_SUBJECT, 
								 $html_mail, 
								 $txt_mail);
				}
			}
			xtc_redirect(xtc_href_link(FILENAME_RMA,'','SSL'));
			break;
		case 'newrma': 
			if (isset($_POST['keyword']) && $_POST['keyword'] != '') {
				$search_product_query = xtc_db_query("SELECT p.products_id, pd.products_name FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd WHERE p.products_id = pd.products_id AND pd.language_id = '".$_SESSION['languages_id']."' AND pd.products_name LIKE '%".$_POST['keyword']."%' OR p.products_model LIKE '%".$_POST['keyword']."%' ORDER BY p.products_id ASC");
			} elseif (isset($_POST['products_id']) && $_POST['products_id'] != '') {
				$search_product_query = xtc_db_query("SELECT p.products_id, pd.products_name FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd WHERE p.products_id = '".(int)$_POST['products_id']."' AND p.products_id = pd.products_id AND pd.language_id = '".$_SESSION['languages_id']."'");
			}		
			
			$products_ids = array();
			while ($search_product = xtc_db_fetch_array($search_product_query)) {
				$products_ids[] = array(
					'id' 	=> $search_product['products_id'],
					'text' 	=> $search_product['products_name'] .' - ID.'. $search_product['products_id']);
			}
		
			$next_rma_id_query = xtc_db_query("SELECT MAX(rma_id+1) AS next_id FROM ".TABLE_RMA);
			$next_rma_id = xtc_db_fetch_array($next_rma_id_query);
			
			$order_ids = array();
			$orders_query = xtc_db_query("SELECT orders_id, DATE_FORMAT(date_purchased , '%d.%m.%Y') AS DATE FROM ".TABLE_ORDERS." ORDER BY orders_id DESC");
			while ($orders = xtc_db_fetch_array($orders_query)) {
				$order_ids[] = array(
					'id' 	=> $orders['orders_id'],
					'text' 	=> $orders['orders_id'] .' - '. $orders['DATE']);
			}
		
			if (isset($_POST['customer_keyword']) && $_POST['customer_keyword'] != '') {
				$customers_query = xtc_db_query("SELECT customers_id, customers_cid, customers_gender, customers_firstname, customers_lastname FROM ".TABLE_CUSTOMERS." WHERE customers_lastname LIKE '%".$_POST['customer_keyword']."%' OR customers_firstname LIKE '%".$_POST['customer_keyword']."%' OR customers_cid LIKE '%".$_POST['customer_keyword']."%' ORDER BY customers_id ASC");
			} elseif (isset($_POST['customers_id']) && $_POST['customers_id'] != '') {
				$customers_query = xtc_db_query("SELECT customers_id, customers_cid, customers_gender, customers_firstname, customers_lastname FROM ".TABLE_CUSTOMERS." WHERE customers_id = '".$_POST['customers_id']."'");
			}
			
			$customers_ids = array();
			while ($customers = xtc_db_fetch_array($customers_query)) {
				$customers_ids[] = array(
					'id' 	=> $customers['customers_id'],
					'text' 	=> $customers['customers_lastname'].' '.$customers['customers_firstname'].', '.PULL_DOWN_CUSTOMER_NO. ''.$customers['customers_cid'].', (ID.'.$customers['customers_id'].')');
			}
			break;		
		case 'showrma':
			$orders = "SELECT rma.rma_id as rma_id, 
							  rma.pickup as pickup, 
							  rma.customers_id as customers_id,
							  rma.shipping_time as shipping_time,
							  rma.cost_estimate as cost_estimate,
							  rma.reason_id,
							  rma.products_ean AS products_ean,
							  rma.orders_id as orders_id,
							  rma.rma_date as rma_date,
							  rma.description,
							  c.customers_firstname as customers_firstname,
							  c.customers_lastname as customers_lastname,
							  p.products_name as products_name,
							  rma.rma_status_id as rma_status_id,
							  rma.description as description 
						 FROM ".TABLE_RMA." rma, 
							  ".TABLE_PRODUCTS_DESCRIPTION." p, 
							  ".TABLE_CUSTOMERS." c 
						WHERE rma.rma_id = '".(int)$_GET['oID']."'
						  AND rma.products_id = p.products_id 
						  AND rma.customers_id = c.customers_id
						  AND p.language_id = ".(int)$_SESSION['languages_id']."";
			$orders_query = xtc_db_query($orders);
			$show_orders = xtc_db_fetch_array($orders_query);
			break;
		default: // alle anzeigen
			if (isset($_GET['sort']) && $_GET['sort'] == 0 || !isset($_GET['sort'])) {
				$sorting = '';
			} elseif (isset($_GET['sort']) && $_GET['sort'] >= 1){
				$sorting = 'AND rma.rma_status_id = '.(int)$_GET['sort'];
			}
			
			$orders_all = "SELECT rma.rma_id as rma_id, 
								  rma.pickup as pickup, 
								  rma.customers_id as customers_id, 
								  rma.shipping_time as shipping_time, 
								  rma.orders_id as orders_id, 
								  rma.rma_date as rma_date,
								  rma.rma_status_id as rma_status_id, 
								  c.customers_firstname as customers_firstname, 
								  c.customers_lastname as customers_lastname, 
								  p.products_name as products_name, 
								  rma.description as description 
							 FROM ".TABLE_RMA." rma, 
								  ".TABLE_PRODUCTS_DESCRIPTION." p, 
								  ".TABLE_CUSTOMERS." c 
							WHERE rma.customers_id = c.customers_id 
							  AND rma.products_id = p.products_id 
							  AND p.language_id = '".(int)$_SESSION['languages_id']."' 
								  ".$sorting."
						 ORDER BY rma.rma_id DESC";
			$orders_all_query = xtc_db_query($orders_all);
			$count_orders = xtc_db_num_rows($orders_all_query);
			break;
	}
