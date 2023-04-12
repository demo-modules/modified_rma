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
       
       echo '
	      <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
	       <tr class="dataTableHeadingRow">
	        <td class="dataTableHeadingContent" style="width:15%;" colspan="2">'.TABLE_HEADING_RMA_NR.'</td>
	        <td class="dataTableHeadingContent" style="width:15%;">'.TABLE_HEADING_DATE.'</td>
	        <td class="dataTableHeadingContent" style="width:25%;">'.TABLE_HEADING_CUSTOMERS.'</td>
	        <td class="dataTableHeadingContent" style="width:10%;">'.TABLE_HEADING_ORDER_ID.'</td>
	        <td class="dataTableHeadingContent" style="width:25%;">'.TABLE_HEADING_PRODUCT.'</td>	
	        <td class="dataTableHeadingContent" style="width:10%;" align="center">'.TABLE_HEADING_STATUS.'</td>
	       </tr>';
       echo xtc_draw_form('rma_action',FILENAME_RMA, 'action=change','post','');
       if ($count_orders > 0) {
       	$i = 0;
       	while ($show_orders = xtc_db_fetch_array($orders_all_query)) {	
	        $rma_status_query = xtc_db_query("SELECT rma_status_id, rma_status_name FROM ".TABLE_RMA_STATUS." WHERE language_id = '".(int)$_SESSION['languages_id']."' AND rma_status_id='".$show_orders['rma_status_id']."'");
	        $rma_status = xtc_db_fetch_array($rma_status_query);
			echo '
			<tr class="dataTableRow2" onmouseover="this.className=\'dataTableRowOver2\';this.style.cursor=\'pointer\'" onmouseout="this.className=\'dataTableRow2\'" >
			  <td class="go_rma" style="padding-left: 5px;" align="center">'.xtc_draw_selection_field('status[]', 'checkbox', $show_orders['rma_id']).'</td>
			  <td class="go_rma_split" style="width:12%; padding-left: 15px; vertical-align:middle;"><a class="content_gift_link" href="' . xtc_href_link(FILENAME_RMA, xtc_get_all_get_params(array('oID', 'action')) . 'oID=' . $show_orders['rma_id'] . '&action=showrma','SSL') . '">'.xtc_image(DIR_WS_ICONS . 'icon_edit.gif', ICON_EDIT, '', '', 'style="position:relative;top:3px;"').'&nbsp;'.$show_orders['rma_id'].'</a></td>
			  <td class="go_rma">'.xtc_datetime_short($show_orders['rma_date']).'</td>
			  <td class="go_rma"><a class="content_gift_link" href="' . xtc_href_link(FILENAME_CUSTOMERS, xtc_get_all_get_params(array('oID', 'action')) . 'cID=' . $show_orders['customers_id'] . '&action=edit','SSL') . '">'.$show_orders['customers_firstname'].' '.$show_orders['customers_lastname'].'</a></td>
			  <td class="go_rma"><a class="content_gift_link" href="' . xtc_href_link(FILENAME_ORDERS, xtc_get_all_get_params(array('oID', 'action')) . 'oID=' . $show_orders['orders_id'] . '&action=edit','SSL') . '">'.'BID-'.$show_orders['orders_id'].'</a></td>
			  <td class="go_rma">'.$show_orders['products_name'].'</td>
			  <td class="go_rma" align="center">'.$rma_status['rma_status_name'].'</td>
			</tr>';
	     	$i++; 
       	}
       		echo '
		    <tr>
		     <td class="no_rma"style="padding-top:5px;" colspan="7">' . xtc_draw_pull_down_menu('rma_action', $change_rma, '', 'style="width:150px;"').' <input type="submit" class="button" style="position:relative;top:-5px;" value="'.RMA_UPDATE.'" onClick="return confirm(\''.UPDATE_ENTRY.'\');" /></td>	
		    </tr>';
       } else {
			echo '
			<tr class="dataTableRow2" onmouseover="this.className=\'dataTableRowOver2\';this.style.cursor=\'pointer\'" onmouseout="this.className=\'dataTableRow2\'" >
			  <td class="no_rma" colspan="7">'.NO_ORDERS.'</td>
			</tr>
			<tr>
			  <td colspan="7"><a class="button" href="'.xtc_href_link(FILENAME_RMA,'','SSL').'">'.RMA_GO_BACK.'</a></td>
			</tr>';
       }
       echo '</form>
       	  </table>';