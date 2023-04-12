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

defined( '_VALID_XTC' ) or die( 'Direct Access to this location is not allowed.' );

switch ($_SESSION['language_code']) {
  case 'de':
    defined('MODULE_MODIFIED_RMA_MENU_TITLE') or define('MODULE_MODIFIED_RMA_MENU_TITLE','Reklamationen');
    break;
  default:
    defined('MODULE_MODIFIED_RMA_MENU_TITLE') or define('MODULE_MODIFIED_RMA_MENU_TITLE','Complaints');
    break;
}

$add_contents[BOX_HEADING_CUSTOMERS][] = array( 
    'admin_access_name' 	=> 'modified_rma', 
    'filename' 				=> FILENAME_RMA, 
    'boxname' 				=> MODULE_MODIFIED_RMA_MENU_TITLE,
    'parameters' 			=> '', 
    'ssl' 					=> ''
  );
  