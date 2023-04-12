<?php
/* -----------------------------------------------------------------------------------------
   MODUL				RMA-Modul fuer modified eCommerce Shopsoftware
   Description			Verwaltung von Kundenreklamationen
   Shopversion			modified-2.0.7.2 (ff)
   PHP					max. PHP 8.1
--------------------------------------------------------------------------------------------
   C R E D I T S
--------------------------------------------------------------------------------------------
   Ersteller			Southbridge.de, 31.01.2006
   Adaption 1.0x		lolly, 14.12.2009
   Weiterentwicklung	wulfy, 11.03.2013
   Korrekturen			ralph_84, 26.03.2013 + 01.04.2013 / bonsai, 20.10.2016
   Anpassung 2.0.7.x	awids, 09.04.2023
--------------------------------------------------------------------------------------------
   License				Released under the GNU General Public License 2
------------------------------------------------------------------------------------------*/

define('RMA_HEADING_TITLE', 'Complaints (RMA)');
define('BOX_HEADING_XTC_TOOL_RMA', 'Customers');
define('EMAIL_RMA_SUBJECT', 'Your RMA request');
define('TABLE_HEADING_RMA_ID', 'RMA');
define('TABLE_HEADING_RMA_NR', 'RMA number');
define('TABLE_HEADING_CUSTOMER_AND_NR', 'Customer/ CustomerID');
define('TABLE_HEADING_CUSTOMERS', 'Customer');
define('TABLE_HEADING_ORDER_ID', 'Order');
define('TABLE_HEADING_PRODUCT', 'Product');
define('TABLE_HEADING_DATE', 'RMA date');
define('TABLE_HEADING_DATE_EDIT', 'Last edit');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_EDIT', 'RMA Edit');
define('TABLE_HEADING_SETTINGS', 'Settings');
define('TABLE_HEADING_SETTINGS_NEW_RMA', 'New RMA Order');
define('TABLE_HEADING_SETTINGS_STATUS', 'Edit RMA Status');
define('TABLE_HEADING_SETTINGS_REASON', 'Edit RMA Reasons');
define('TABLE_HEADING_SETTINGS_EDIT', 'Edit RMA order');
define('TABLE_HEADING_SETTINGS_STATUS_NEW', 'New RMA Status');
define('TABLE_HEADING_SETTINGS_REASON_NEW', 'New RMA Order Reason');
define('TABLE_HEADING_SETTINGS_NAVI', 'Navigation');
define('TABLE_HEADING_SETTINGS_NAVI_OVERVIEW', 'Overview');
define('TABLE_HEADING_OPEN_NEW_RMA', 'Enter new RMA order');
define('PULL_DOWN_CUSTOMER_NO', 'Customer No.');
define('BUTTON_PRODUCT_SEARCH', 'Search');
define('TABLE_FOOTER_ACTION_0', 'Please select');
define('TABLE_FOOTER_ACTION_DELETE_ALL', 'Delete selected');
define('TABLE_HEADING_SELECT_1','RMA overview');
define('TABLE_HEADING_SELECT_0','Please select');
define('TABLE_HEADING_SELECT_ALL','Please select');
define('ENTRY_PRODUCT', 'Article');
define('ENTRY_FROM', 'from');
define('ENTRY_DATE', 'Date');
define('TEXT_STATUS_OPEN', 'Open');
define('TEXT_STATUS_CLOSE', 'Processed');
define('TEXT_CUSTOMERS_NAME', '<b>Customer</b>');
define('TEXT_INFO_HEADING_EDIT', 'Edit');
define('TEXT_IF_STATUS_OPEN', '<b>Is the order still open?</b>');
define('TEXT_IF_STATUS_OPEN_INFO', 'Yes (enabled)');
define('TEXT_IF_PICKUP', 'Pickup');
define('TEXT_IF_PICKUP_INFO', 'Yes (enabled)');
define('TEXT_SHIPPING_TIME', 'Item received on');
define('TEXT_REASON', 'Reason for RMA request');
define('TEXT_RMA_REASON', 'RMA reason');
define('TEXT_RMA_REASON_NEW', 'New RMA Reason');
define('TEXT_PICKUP_YES', 'Yes');
define('TEXT_PICKUP_NO', 'No');
define('TEXT_NO_DATA', 'No entry');
define('TEXT_RMA_ID', 'RMA ID ');
define('TEXT_PRODUCTS_EAN', 'Serial No./GTIN/EAN');
define('TEXT_DESCRIPTION', 'Error Description');
define('TEXT_INFO_HEADING_DELETE_RMA', '<b>Delete RMA</b>');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this RMA order?');
define('TEXT_DISPLAY_NUMBER_OF_RMA','Displays <b>%d</b> to <b>%d</b> (of a total of <b>%d</b> RMA orders)');
define('TEXT_UPDATE', 'Update');
define('TEXT_UPDATE_SAVE', 'Save');
define('TEXT_SAVE', 'Paste');
define('TEXT_STATUS_DELETE', 'Delete');
define('NO_ORDERS', 'No orders.');
define('NO_STATS', 'Currently no data available. As soon as you change the status, this will be documented by an entry here.');
define('RMA_STATISTIC', 'History');
define('RMA_STATISTIC_SHOW', 'Show History');
define('RMA_STATISTIC_NO_SHOW', 'Hide History');
define('RMA_OPTIONS', 'Options');
define('RMA_EDIT_STATUS', 'New RMA Status');
define('RMA_TEXT', 'Load Text');
define('RMA_COMMENT', 'email text');
define('RMA_COMMENT_SEND', 'Send email text?');
define('RMA_COMMENT_SEND_HELP', 'If not, this process will only be saved!');
define('RMA_COMMENT_EDIT_HELP', 'Click on the checkbox, then select and confirm an action.');
define('RMA_MAIL_SEND', 'Send RMA status?');
define('RMA_UPDATE','Update');
define('UPDATE_ENTRY','Are you sure?');
define('TEXT_IF_COST_ESTIMATE', 'Cost Estimate');
define('TEXT_COAST_ESTIMATE_NO', 'No');
define('TEXT_COAST_ESTIMATE_YES', 'Yes');
define('TEXT_SYSTEM_INFO_RMA', 'Will be assigned automatically!');
define('TEXT_SYSTEM_INFO_RMA_NOCHANGE', 'Please do not change this number!');
define('TEXT_SYSTEM_INFO_NO_DATE', 'If the customer does not know a date, enter the delivery note date or unknown!');
define('RMA_MESSAGE', 'Email Options');
define('RMA_GO_BACK', 'Back');
define('RMA_NOTICE_HEADLINE', 'Notices');
define('RMA_NOTICE_1', '<u>Customer</u><br><span style="font-weight:normal;">First search for the customer, for example by last name. Click on "Search " and select the right customer from the suggested list.</span>');
define('RMA_NOTICE_2', '<u>Product</u><br><span style="font-weight:normal;">Find out the product to be complained about. The more relevant the keyword, the better you will find the product by pressing the "Search" button.</span>');
define('RMA_NOTICE_3', '<u>Serial no./GTIN/EAN</u><br><span style="font-weight:normal;">Optionally, the serial number, GTIN or EAN can be stored.</span>');
define('RMA_NOTICE_4', '<u>RMA number</u><br><span style="font-weight:normal;">The RMA number is assigned automatically and cannot be changed.</span >');
define('RMA_NOTICE_5', '<u>Item received on</u><br><span style="font-weight:normal;">If the customer does not know the date, enter the delivery note date, or enter unknown</span> ');
// number of texts
define('COUNT_TEXT_ORDERS','5');
define('TEXT_ORDERS_TITLE_0','RMA in progress');
define('TEXT_ORDERS_TEXT_0','Your RMA request is currently being processed.');
define('TEXT_ORDERS_TITLE_1','RMA request approved and sent');
define('TEXT_ORDERS_TEXT_1','Your RMA request has been approved and a letter is on its way to you with the RMA return slip and a parcel stamp.');
define('TEXT_ORDERS_TITLE_2','RMA declined');
define('TEXT_ORDERS_TEXT_2','Your RMA request has been rejected. This may be due to an insufficient error description or your item is excluded from return.');
define('TEXT_ORDERS_TITLE_3','RMA open');
define('TEXT_ORDERS_TEXT_3','Your RMA request has been submitted. It will take some time to process.');
define('TEXT_ORDERS_TITLE_4','RMA under review');
define('TEXT_ORDERS_TEXT_4','Your RMA request is currently being checked. The processing will take some time. If necessary, we ask you for further information.');
?>