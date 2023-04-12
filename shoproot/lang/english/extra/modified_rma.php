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

define('RMA_NUMBER', 'No.: ');
define('RMA_DATE', 'Date: ');
define('NAVBAR_TITLE_RMA','RMA order');
define('NAVBAR_TITLE_RMA_OVERVIEW','Overview of RMA Orders');
define('NAVBAR_TITLE_RMA_REQUEST','New RMA Request');
define('RMA_OVERVIEW_TEXT', 'To the RMA overview');
define('RMA_OVERVIEW_LINK', 'Return item (complaint)');
define('RMA_TEXT_SHOW', 'Show');
define('RMA_TEXT_FROM', ' from ');
define('RMA_PRODUCTS_PLEASE_SELECT','please select');
define('ENTRY_RMA_PRODUCTS','Please select the article to be returned!');
define('ENTRY_RMA_ERROR_MESSAGE','Please enter a detailed error description!');
define('ENTRY_RMA_ERROR_MESSAGE_LENGTH','Unfortunately, the error description is too short!');
define('ENTRY_RMA_PRODUCTS_EAN','Please enter the EAN or serial number of the product!');
define('ENTRY_RMA_REASON','Please select the reason for your order!');