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

class modified_rma {
  var $code, $title, $description, $enabled;

  function __construct() {
     $this->code = 'modified_rma';
     $this->title = MODULE_MODIFIED_RMA_TEXT_TITLE;
     $this->description = MODULE_MODIFIED_RMA_TEXT_DESCRIPTION;
     $this->sort_order = defined('MODULE_MODIFIED_RMA_SORT_ORDER') ? MODULE_MODIFIED_RMA_SORT_ORDER : '';
     $this->enabled = ((defined('MODULE_MODIFIED_RMA_STATUS') && MODULE_MODIFIED_RMA_STATUS == 'true') ? true : false);
  }

  function process($file) {
  }

  function display() {
    return array('text' => '<br /><div align="center">' . xtc_button(BUTTON_SAVE) .
                           xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_MODULE_EXPORT, 'set=' . $_GET['set'] . '&module=modified_rma')) . "</div>");
  }

  function check() {
    if (!isset($this->_check)) {
      $check_query = xtc_db_query("SELECT configuration_value 
                                     FROM " . TABLE_CONFIGURATION . "
                                    WHERE configuration_key = 'MODULE_MODIFIED_RMA_STATUS'");
      $this->_check = xtc_db_num_rows($check_query);
    }
    return $this->_check;
  }
    
  function install() {
    // write configuration
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_STATUS', 'true',  '6', '1', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");  
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION', 'true', 6, 2, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW', 'true', 6, 3, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION', 'true', 6, 4, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW', 'true', 6, 5, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
	xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH', '50',  '6', '6', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION', 'true', 6, 7, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_PICK_UP_SHOW', 'true', 6, 8, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW', 'true', 6, 9, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
	// create tables
	xtc_db_query("CREATE TABLE rma (rma_id int(11) NOT NULL AUTO_INCREMENT, customers_id int(11) NOT NULL default '0', orders_id int(11) NOT NULL default '0', products_id int(11) NOT NULL default '0', products_ean varchar(40) default NULL, reason_id int(11) NOT NULL default '0', description longtext NOT NULL, rma_date datetime NOT NULL default '0000-00-00 00:00:00', pickup smallint(1) default NULL, shipping_time varchar(40) default NULL, rma_status_id tinyint(1) NOT NULL default '1', cost_estimate smallint(1) default NULL, PRIMARY KEY (rma_id)) AUTO_INCREMENT = 1");
	xtc_db_query("CREATE TABLE rma_comments (rma_comments_id int(11) NOT NULL AUTO_INCREMENT, rma_id int(11) NOT NULL default '0', rma_status_id tinyint(2) NOT NULL default '0', comments text NOT NULL, edit_date datetime NOT NULL default '0000-00-00 00:00:00', PRIMARY KEY (rma_comments_id)) AUTO_INCREMENT = 1");
	xtc_db_query("CREATE TABLE rma_reason (rma_reason_id int(11) NOT NULL default '0', language_id int(11) NOT NULL default '1', rma_reason_name varchar(64) NOT NULL default '', PRIMARY KEY (rma_reason_id,language_id), KEY idx_rma_reason_name (rma_reason_name))");
	xtc_db_query("CREATE TABLE rma_status (rma_status_id int(11) NOT NULL default '0', language_id int(11) NOT NULL default '1', rma_status_name varchar(128) NOT NULL default '', PRIMARY KEY (rma_status_id,language_id), KEY idx_rma_status_name (rma_status_name))");
	// insert values into table rma_reason
	xtc_db_query("INSERT INTO rma_reason (rma_reason_id, language_id, rma_reason_name) VALUES (1, 1, 'Product defectively')"); 
	xtc_db_query("INSERT INTO rma_reason (rma_reason_id, language_id, rma_reason_name) VALUES (1, 2, 'Ware defekt')");
	xtc_db_query("INSERT INTO rma_reason (rma_reason_id, language_id, rma_reason_name) VALUES (2, 1, 'Wrong delivery')");
	xtc_db_query("INSERT INTO rma_reason (rma_reason_id, language_id, rma_reason_name) VALUES (2, 2, 'Falschlieferung')");
	// insert values into table rma_status
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (1, 1, 'Open')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (1, 2, 'Offen')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (2, 1, 'In Processing')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (2, 2, 'In Bearbeitung')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (3, 1, 'Sent')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (3, 2, 'Versendet')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (4, 1, 'Refuse')");
	xtc_db_query("INSERT INTO rma_status (rma_status_id, language_id, rma_status_name) VALUES (4, 2, 'Abgelehnt')");
	// add admin access
	xtc_db_query("ALTER TABLE admin_access ADD modified_rma int(1) NOT NULL DEFAULT 1");  
  }

  function remove() {
    xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
    xtc_db_query("ALTER TABLE admin_access DROP modified_rma");
    xtc_db_query("DROP TABLE rma");
    xtc_db_query("DROP TABLE rma_comments");
    xtc_db_query("DROP TABLE rma_reason");
    xtc_db_query("DROP TABLE rma_status");
  }

  function keys() {
    $key = array(
      'MODULE_MODIFIED_RMA_STATUS',
      'MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION',
      'MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH',
      'MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION',
      'MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW',
      'MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW',
      'MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION',
      'MODULE_MODIFIED_RMA_PICK_UP_SHOW',
      'MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW',
    );

    return $key;
  }
}
?>