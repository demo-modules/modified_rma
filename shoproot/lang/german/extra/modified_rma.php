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

define('RMA_NUMBER', 'Nr.: ');
define('RMA_DATE', 'Datum: ');
define('NAVBAR_TITLE_RMA','RMA-Auftrag');

define('NAVBAR_TITLE_RMA_OVERVIEW','&Uuml;bersicht der RMA-Auftr&auml;ge');
define('NAVBAR_TITLE_RMA_REQUEST','Neuer RMA-Auftrag');

define('RMA_OVERVIEW_TEXT', 'Zur RMA-&Uuml;bersicht');
define('RMA_OVERVIEW_LINK', 'Artikel zur&uuml;ckgeben (Reklamation)');
define('RMA_TEXT_SHOW', 'Anzeigen');
define('RMA_TEXT_FROM', ' vom ');
define('RMA_PRODUCTS_PLEASE_SELECT','bitte w&auml;hlen');
define('ENTRY_RMA_PRODUCTS','Bitte den zu reklamierenden Artikel ausw&auml;hlen!');
define('ENTRY_RMA_ERROR_MESSAGE','Bitte eine ausf&uuml;hrliche Fehlerbeschreibung eintragen!');
define('ENTRY_RMA_ERROR_MESSAGE_LENGTH','Die Fehlerbeschreibung ist leider zu kurz!');
define('ENTRY_RMA_PRODUCTS_EAN','Bitte die EAN oder Seriennummer des Produktes eintragen!');
define('ENTRY_RMA_REASON','Bitte den Grund Ihres Auftrages ausw&auml;hlen!');