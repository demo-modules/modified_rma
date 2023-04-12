<?php
/* -----------------------------------------------------------------------------------------
   MODUL:				RMA-Modul für modified eCommerce Shopsoftware
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

defined('MODULE_MODIFIED_RMA_TEXT_TITLE') or define('MODULE_MODIFIED_RMA_TEXT_TITLE','RMA-Modul für modified eCommerce Shopsoftware');
defined('MODULE_MODIFIED_RMA_TEXT_DESCRIPTION') or define('MODULE_MODIFIED_RMA_TEXT_DESCRIPTION','Verwaltung von Kundenreklamationen');
defined('MODULE_MODIFIED_RMA_STATUS_TITLE') or define('MODULE_MODIFIED_RMA_STATUS_TITLE','RMA-Modul aktivieren');
defined('MODULE_MODIFIED_RMA_STATUS_DESC') or define('MODULE_MODIFIED_RMA_STATUS_DESC','Aktivieren / deaktivieren, um Anzeige zu steuern.');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_TITLE','EAN-Nummer anzeigen');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_DESC') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_SHOW_DESC','Zeigt an / Blendet aus die Eingabe der Serien-Nummer.');
defined('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_TITLE') or define('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_TITLE','Auswahl der Artikel');
defined('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_DESC') or define('MODULE_MODIFIED_RMA_CHOOSE_PRODUCTS_OBLIGATION_DESC','Aktivieren um die Auswahl der Artikel als Pflichtauswahl zu erm&ouml;glichen. Sollte stets aktiviert sein!');
defined('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_TITLE','Fehlerbeschreibung anzeigen');
defined('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_DESC') or define('MODULE_MODIFIED_RMA_ERROR_MESSAGE_SHOW_DESC','Zeigt an / Blendet aus die Eingabe der Fehlerbeschreibung.');
defined('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_TITLE') or define('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_TITLE','Mindesl&auml;nge der Fehlerbeschreibung');
defined('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_DESC') or define('MODULE_MODIFIED_RMA_ENTRY_ERROR_MESSAGE_MIN_LENGTH_DESC','Geben Sie hier einen Wert f&uuml;r f&uuml;r Zeichen- L&auml;nge der Fehlerbeschreibung ein.');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_TITLE') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_TITLE','Eingabe der EAN-Nummer');
defined('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_DESC') or define('MODULE_MODIFIED_RMA_PRODUCTS_EAN_OBLIGATION_DESC','Aktivieren, um die Eingabe der Seriennummer zu erzwingen.');
defined('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_TITLE') or define('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_TITLE','Auswahl des Grundes f&uuml;r den RMA-Auftrag');
defined('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_DESC') or define('MODULE_MODIFIED_RMA_CHOOSE_REASON_OBLIGATION_DESC','Aktivieren, um die Auswahl des RMA-Auftrages zu erzwingen.');
defined('MODULE_MODIFIED_RMA_PICK_UP_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_PICK_UP_SHOW_TITLE','Artikelabholung anzeigen');
defined('MODULE_MODIFIED_RMA_PICK_UP_SHOW_DESC') or define('MODULE_MODIFIED_RMA_PICK_UP_SHOW_DESC','Zeigt an / Blendet aus die Eingabe der Artikelabholung.');
defined('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_TITLE') or define('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_TITLE','Kostenvoranschlag anzeigen');
defined('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_DESC') or define('MODULE_MODIFIED_RMA_COST_ESTIMATE_SHOW_DESC','Zeigt an / Blendet aus die Eingabe des Kostenvoranschlages.');
