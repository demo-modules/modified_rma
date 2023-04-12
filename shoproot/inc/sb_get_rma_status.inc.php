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

	function sb_get_status($status_id) {
				
	  $status_query = xtc_db_query("SELECT 
				rma_status_name 
					FROM " . TABLE_RMA_STATUS." 
						WHERE rma_status_id = '".(int)$status_id."'
						AND language_id = '".(int)$_SESSION['languages_id']."'");
		$status = xtc_db_fetch_array($status_query);
		
		return $status['rma_status_name'];
	}
 ?>