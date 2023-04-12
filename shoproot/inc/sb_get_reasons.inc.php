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

	function sb_get_reasons($reason_array = '') {
		$reason_array = array();
		$reason_array[] = array('id' => 0,'text' => PULL_DOWN_DEFAULT);
		$reason_query = xtc_db_query("SELECT rma_reason_id, rma_reason_name FROM ".TABLE_RMA_REASON." WHERE language_id = '".(int)$_SESSION['languages_id']."'");
		if (xtc_db_num_rows($reason_query) > 0) {				
			while ($reason = xtc_db_fetch_array($reason_query, true)) {
				$reason_array[] = array(
					'id' 	=> $reason['rma_reason_id'],
					'text'	=> $reason['rma_reason_name']);
			} 
		} 
		return $reason_array;
	}
	
	function sb_get_reason($reason_id) {
		$reason_query = xtc_db_query("SELECT rma_reason_name FROM ".TABLE_RMA_REASON." WHERE rma_reason_id = '".(int)$reason_id."' AND language_id = '".(int)$_SESSION['languages_id']."'");
		if (xtc_db_num_rows($reason_query) > 0) {
			$reason = xtc_db_fetch_array($reason_query);
			return $reason['rma_reason_name'];
		} else {
			return;
		}
	}

	function sb_get_rma_reasons($name, $selected = '', $parameters = '') {
		$reason_array = array();
		$reason_array[] = array('id' => '0','text' => RMA_PRODUCTS_PLEASE_SELECT); // standard
		$reason_query = xtc_db_query("SELECT rma_reason_id, rma_reason_name FROM " . TABLE_RMA_REASON." WHERE language_id = '".(int)$_SESSION['languages_id']."'");
		if (xtc_db_num_rows($reason_query) > 0) {
			while ($reason = xtc_db_fetch_array($reason_query)) {
				$reason_array[] = array(
					'id' 	=> $reason['rma_reason_id'],
					'text'	=> $reason['rma_reason_name']);
			}
		}
		if (is_array($name)) return xtc_draw_pull_down_menuNote($name, $reason_array, $selected, $parameters);
		$reason_pull_down_menu = xtc_draw_pull_down_menu($name, $reason_array);
		return $reason_pull_down_menu;
	}	
 ?>