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

define('RMA_HEADING_TITLE', 'Reklamationen (RMA)');
define('BOX_HEADING_XTC_TOOL_RMA', 'Kunden');
define('EMAIL_RMA_SUBJECT', 'Ihre RMA-Anfrage');
define('TABLE_HEADING_RMA_ID', 'RMA');
define('TABLE_HEADING_RMA_NR', 'RMA Nummer');
define('TABLE_HEADING_CUSTOMER_AND_NR', 'Kunde/ KundenNr');
define('TABLE_HEADING_CUSTOMERS', 'Kunde');
define('TABLE_HEADING_ORDER_ID', 'Auftrag');
define('TABLE_HEADING_PRODUCT', 'Produkt');
define('TABLE_HEADING_DATE', 'RMA-Datum');
define('TABLE_HEADING_DATE_EDIT', 'Letzte Bearbeitung');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_EDIT', 'RMA Bearbeiten');
define('TABLE_HEADING_SETTINGS', 'Einstellungen');
define('TABLE_HEADING_SETTINGS_NEW_RMA', 'Neuer RMA Auftrag');
define('TABLE_HEADING_SETTINGS_STATUS', 'RMA-Status bearbeiten');
define('TABLE_HEADING_SETTINGS_REASON', 'RMA-Gr&uuml;nde bearbeiten');
define('TABLE_HEADING_SETTINGS_EDIT', 'RMA-Auftrag bearbeiten');
define('TABLE_HEADING_SETTINGS_STATUS_NEW', 'Neuer RMA-Status');
define('TABLE_HEADING_SETTINGS_REASON_NEW', 'Neuer RMA-Auftragsgrund');
define('TABLE_HEADING_SETTINGS_NAVI', 'Navigation');
define('TABLE_HEADING_SETTINGS_NAVI_OVERVIEW', '&Uuml;bersicht');
define('TABLE_HEADING_OPEN_NEW_RMA', 'Neuen RMA Auftrag erfassen');
define('PULL_DOWN_CUSTOMER_NO', 'Kd.-Nr.');
define('BUTTON_PRODUCT_SEARCH', 'Suchen');
define('TABLE_FOOTER_ACTION_0', 'Bitte ausw&auml;hlen');
define('TABLE_FOOTER_ACTION_DELETE_ALL', 'Markierte l&ouml;schen');
define('TABLE_HEADING_SELECT_1','RMA &Uuml;bersicht');
define('TABLE_HEADING_SELECT_0','Bitte ausw&auml;hlen');
define('TABLE_HEADING_SELECT_ALL','Bitte ausw&auml;hlen');
define('ENTRY_PRODUCT', 'Artikel');
define('ENTRY_FROM', 'von');
define('ENTRY_DATE', 'Datum');
define('TEXT_STATUS_OPEN', 'Offen');
define('TEXT_STATUS_CLOSE', 'Verarbeitet');
define('TEXT_CUSTOMERS_NAME', '<b>Kunde</b>');
define('TEXT_INFO_HEADING_EDIT', '&Auml;ndern');
define('TEXT_IF_STATUS_OPEN', '<b>Ist der Auftrag noch offen?</b>');
define('TEXT_IF_STATUS_OPEN_INFO', 'Ja (aktiviert)');
define('TEXT_IF_PICKUP', 'Abholung');
define('TEXT_IF_PICKUP_INFO', 'Ja (aktiviert)');
define('TEXT_SHIPPING_TIME', 'Artikel erhalten am');
define('TEXT_REASON', 'Grund des RMA-Auftrages');
define('TEXT_RMA_REASON', 'RMA Grund');
define('TEXT_RMA_REASON_NEW', 'Neuer RMA-Grund');
define('TEXT_PICKUP_YES', 'Ja');
define('TEXT_PICKUP_NO', 'Nein');
define('TEXT_NO_DATA', 'Keine Angabe');
define('TEXT_RMA_ID', 'RMA-ID ');
define('TEXT_PRODUCTS_EAN', 'Serien-Nr./GTIN/EAN');
define('TEXT_DESCRIPTION', 'Fehlerbeschreibung');
define('TEXT_INFO_HEADING_DELETE_RMA', '<b>RMA l&ouml;schen</b>');
define('TEXT_INFO_DELETE_INTRO', 'Wollen Sie wirklich diesen RMA-Auftrag l&ouml;schen?');
define('TEXT_DISPLAY_NUMBER_OF_RMA','Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> RMA-Auftr&auml;gen)');
define('TEXT_UPDATE', 'Aktualisieren');
define('TEXT_UPDATE_SAVE', 'Speichern');
define('TEXT_SAVE', 'Einf&uuml;gen');
define('TEXT_STATUS_DELETE', 'L&ouml;schen');
define('NO_ORDERS', 'Keine Auftr&auml;ge.');
define('NO_STATS', 'Aktuell keine Daten vorhanden. Sobald Sie den Status &auml;ndern, wird dies hier durch einen Eintrag dokumentiert.');
define('RMA_STATISTIC', 'Verlauf');
define('RMA_STATISTIC_SHOW', 'Verlauf anzeigen');
define('RMA_STATISTIC_NO_SHOW', 'Verlauf ausblenden');
define('RMA_OPTIONS', 'Optionen');
define('RMA_EDIT_STATUS', 'Neuer RMA-Status');
define('RMA_TEXT', 'Text laden');
define('RMA_COMMENT', 'eMail-Text');
define('RMA_COMMENT_SEND', 'eMail-Text mitsenden?');
define('RMA_COMMENT_SEND_HELP', 'Wenn nicht, wird dieser Vorgang nur abgespeichert!');
define('RMA_COMMENT_EDIT_HELP', 'Checkbox anklicken, anschlie&szlig;end Aktion ausw&auml;hlen und best&auml;tigen.');
define('RMA_MAIL_SEND', 'RMA-Status mitsenden?');
define('RMA_UPDATE','Aktualisieren');
define('UPDATE_ENTRY','Sind Sie sicher?');
define('TEXT_IF_COST_ESTIMATE', 'Kostenvoranschlag');
define('TEXT_COAST_ESTIMATE_NO', 'Nein');
define('TEXT_COAST_ESTIMATE_YES', 'Ja');
define('TEXT_SYSTEM_INFO_RMA', 'Wird automatisch vergeben!');
define('TEXT_SYSTEM_INFO_RMA_NOCHANGE', 'Diese Nummer bitte nicht &auml;ndern!');
define('TEXT_SYSTEM_INFO_NO_DATE', 'Falls dem Kunden kein Datum bekannt ist, Lieferscheindatum, oder Unbekannt eintragen!');
define('RMA_MESSAGE', 'eMail-Optionen');
define('RMA_GO_BACK', 'Zur&uuml;ck');
define('RMA_NOTICE_HEADLINE', 'Hinweise');
define('RMA_NOTICE_1', '<u>Kunde</u><br><span style="font-weight:normal;">Suchen Sie zuerst den Kunden, z. B. anhand des Nachnamens. Klicken Sie auf "Suchen" und w&auml;hlen den richtigen Kunden aus der Vorschlag-Liste aus.</span>');
define('RMA_NOTICE_2', '<u>Produkt</u><br><span style="font-weight:normal;">Suchen Sie anschlie&szlig;end das zu reklamierende Produkt heraus. Je treffender das Keyword ist, desto eher werden Sie das Produkt nach Bet&auml;tigung des "Suchen"-Buttons finden.</span>');
define('RMA_NOTICE_3', '<u>Serien-Nr./GTIN/EAN</u><br><span style="font-weight:normal;">Optional kann die Seriennummer, GTIN oder EAN hinterlegt werden.</span>');
define('RMA_NOTICE_4', '<u>RMA Nummer</u><br><span style="font-weight:normal;">Die RMA-Nummer wird automatisch vergeben und kann nicht ge&auml;ndert werden.</span>');
define('RMA_NOTICE_5', '<u>Artikel erhalten am</u><br><span style="font-weight:normal;">Falls dem Kunden kein Datum bekannt ist, Lieferscheindatum, oder Unbekannt eintragen</span>');
// Anzahl der Texte
define('COUNT_TEXT_ORDERS','5'); 
define('TEXT_ORDERS_TITLE_0','RMA in Bearbeitung');
define('TEXT_ORDERS_TEXT_0','Ihr RMA-Antrag ist im Moment in Bearbeitung.');
define('TEXT_ORDERS_TITLE_1','RMA Antrag genehmigt und versendet');
define('TEXT_ORDERS_TEXT_1','Ihr RMA-Antrag wurde genehmigt und ein Brief mit dem RMA R&uuml;cksendeschein und einer Paketmarke ist auf dem Weg zu Ihnen.');
define('TEXT_ORDERS_TITLE_2','RMA abgelehnt');
define('TEXT_ORDERS_TEXT_2','Ihr RMA-Antrag wurde abgelehnt. Grund hierf&uuml;r kann eine unzureichende Fehlerbeschreibung sein oder Ihr Artikel ist von einer R&uuml;cknahme ausgeschlossen.');
define('TEXT_ORDERS_TITLE_3','RMA offen');
define('TEXT_ORDERS_TEXT_3','Ihr RMA-Antrag wurde eingereicht. Die Bearbeitung nimmt etwas Zeit in Anspruch.');
define('TEXT_ORDERS_TITLE_4','RMA in Pr&uuml;fung');
define('TEXT_ORDERS_TEXT_4','Ihr RMA-Antrag wird aktuell gepr&uuml;ft. Die Bearbeitung nimmt etwas Zeit in Anspruch. Gegebenenfalls bitten wir Sie um weitere Angaben.');
?>