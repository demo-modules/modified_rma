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

defined('MODULE_MODIFIED_RMA_TEXT_TITLE') or define('MODULE_MODIFIED_RMA_TEXT_TITLE','RMA module for modified eCommerce shop software');
defined('MODULE_MODIFIED_RMA_TEXT_DESCRIPTION') or define('MODULE_MODIFIED_RMA_TEXT_DESCRIPTION','Customer Complaint Management');
defined('MODULE_MODIFIED_RMA_STATUS_TITLE') or define('MODULE_MODIFIED_RMA_STATUS_TITLE','Activate RMA Module');
defined('MODULE_MODIFIED_RMA_STATUS_DESC') or define('MODULE_MODIFIED_RMA_STATUS_DESC','Enable / disable to control display.');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_TITLE','Show EAN number');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_DESC') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_DESC','Shows / hides the input of the serial number.');
defined('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_TITLE') or define('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_TITLE','Selection of Articles');
defined('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_DESC') or define('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_DESC','Enable to enable the selection of the articles as mandatory. Should always be enabled!');
defined('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_TITLE','Show error description');
defined('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_DESC') or define('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_DESC','Shows / Hides the input of the error description.');
defined('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_TITLE') or define('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_TITLE','minimum length of error description');
defined('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_DESC') or define('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_DESC','Enter a value for the character length of the error description here.');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_TITLE') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_TITLE','Entering the EAN number');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_DESC') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_DESC','Enable to force serial number entry.');
defined('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_TITLE') or define('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_TITLE','Select Reason for RMA Order');
defined('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_DESC') or define('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_DESC','Enable to force RMA order selection.');
defined('MODULE_MODIFIED_RMA_PICK_UP_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_PICK_UP_SHOW_TITLE','Show item pickup');
defined('MODULE_MODIFIED_RMA_PICK_UP_SHOW_DESC') or define('MODULE_MODIFIED_RMA_PICK_UP_SHOW_DESC','Shows / hides the item pickup entry.');
defined('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_TITLE','Show Estimate');
defined('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_DESC') or define('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_DESC','Shows / hides the cost estimate entry.');