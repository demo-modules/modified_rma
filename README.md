# modified_rma

## Beschreibung

Ein ursprünglich 2006 von Southbridge.de erstelltes RMA-Modul, angepasst an die aktuelle Shopversion modified-2.0.7.2, lauffähig bis PHP 8.1.

## Installation

1. Dateien gemäß der vorgegebenen Ordnerstruktur hochladen. Es werden hierbei keine Dateien überschrieben.

2. Das Modul im Backend unter Module > System Module > RMA-Modul für modified eCommerce Shopsoftware installieren und im Modul erste Einstellungen vornehmen (z. B. Status anlegen / ändern.

3. In der Datei /templates/tpl_modified_responsive/module/account.html nach Zeile 60 (<p><a href="{ $LINK_ALL }">{#text_all#}</a></p>) folgendes einfügen:
  
    {if defined($smarty.const.MODULE_MODIFIED_RMA_STATUS) && $smarty.const.MODULE_MODIFIED_RMA_STATUS == 'true'}
      <p><a href="{$smarty.const.FILENAME_RMA_OVERVIEW|xtc_href_link}">{$smarty.const.RMA_OVERVIEW_LINK}</a></p>
    {/if}

## Verwaltung

RMAs können Sie im Backend unter Kunden > Reklamationen verwalten.
