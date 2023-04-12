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

// include needed functions
  include_once(DIR_FS_INC . 'xtc_draw_pull_down_menu.inc.php');
  
  function sb_get_rma_products($order_id, $name, $selected = '', $parameters ='')
	{
		$products_query = xtc_db_query("select
	    products_id,
			products_name
	  from ".TABLE_ORDERS_PRODUCTS." 
	  where orders_id = '". $order_id ."'");
		
		$products_array = array();
		$products_array[] = array('id' => '0','text' => RMA_PRODUCTS_PLEASE_SELECT); // standard
		
		$nr = 1;
		while($products = xtc_db_fetch_array($products_query)){
			$products_array[] = array(
				'id' => $products['products_id'], 
				'text' => $nr .'. '. $products['products_name']);
		$nr++;		
	}
		
		if (is_array($name)) return xtc_draw_pull_down_menuNote($name, $products_array, $selected, $parameters);
		$products_pull_down_menu = xtc_draw_pull_down_menu($name, $products_array);
		
    return $products_pull_down_menu;
  }
?>