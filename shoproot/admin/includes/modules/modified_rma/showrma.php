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


echo '	<table class="clear tableCenter collapse">
		  <tbody>
		    <tr>
		      <td class="boxCenterLeft">
			      <div class="heading"><strong>'.TABLE_HEADING_SETTINGS_NAVI_OVERVIEW.'</strong></div>
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			        <tbody>
			          <tr>
			            <td valign="top" width="50%">
					      <table width="100%" border="0" cellspacing="1" cellpadding="2">
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_RMA_NR.'</td>
					        <td class="content_rma">&nbsp;'.$show_orders['rma_id'].'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_DATE.'</td>
					        <td class="content_rma">&nbsp;'.xtc_datetime_short($show_orders['rma_date']).'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_PRODUCT.'</td>
					        <td class="content_rma" style="padding-left:1px;">&nbsp;'.$show_orders['products_name'].'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_PRODUCTS_EAN.'</td>
					        <td class="content_rma">&nbsp;'.($show_orders['products_ean'] ? $show_orders['products_ean'] : '-').'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_ORDER_ID.'</td>
					        <td class="content_rma" style="padding-left: 4px;">&nbsp;'.'<a class="content_gift_link" href="' . xtc_href_link(FILENAME_ORDERS, xtc_get_all_get_params(array('oID', 'action')) . 'oID=' . $show_orders['orders_id'] . '&action=edit','SSL') . '">'.'BID-'.$show_orders['orders_id'].'</a></td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_CUSTOMERS.'</td>
					        <td class="content_rma" style="padding-left: 4px;">&nbsp;'.'<a class="content_gift_link" href="' . xtc_href_link(FILENAME_CUSTOMERS, xtc_get_all_get_params(array('oID', 'action')) . 'cID=' . $show_orders['customers_id'] . '&action=edit','SSL') . '">'.$show_orders['customers_firstname'].' '.$show_orders['customers_lastname'].'</a>'.'</td>
					       </tr>
					      </table>
			            </td>
			            <td valign="top" width="50%">
					      <table width="100%" border="0" cellspacing="1" cellpadding="2">
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_SHIPPING_TIME.'</td>
					        <td class="content_rma">'.$show_orders['shipping_time'].'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_IF_PICKUP.'</td>
					        <td class="content_rma">'.($show_orders['pickup'] == 1 ? TEXT_PICKUP_YES : TEXT_PICKUP_NO).'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_IF_COST_ESTIMATE.'</td>
					        <td class="content_rma">'.($show_orders['cost_estimate'] == 1 ? TEXT_COAST_ESTIMATE_YES : TEXT_COAST_ESTIMATE_NO).'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_RMA_REASON.'</td>
					        <td class="content_rma">'.sb_get_reason($show_orders['reason_id']).'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma" valign="top">&nbsp;'.TEXT_DESCRIPTION.'</td>
					        <td class="content_rma">'.$show_orders['description'].'</td>
					       </tr>
					      </table>
			            </td>
			          </tr>
			        </tbody>
			      </table>
			      <br /><br />
			      <div class="heading"><strong>'.RMA_OPTIONS.'</strong></div>';
					echo xtc_draw_form('edit_rma',FILENAME_RMA, 'action=update_rma','post','');
					echo xtc_draw_hidden_field('customers_id',$show_orders['customers_id']);
					echo xtc_draw_hidden_field('orders_id',$show_orders['orders_id']);
					echo xtc_draw_hidden_field('rma_id',$show_orders['rma_id']);
			        echo '
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			       <tr>
			        <td class="header_viewrma" style="height:30px">&nbsp;'.RMA_EDIT_STATUS.'</td>
			        <td class="content_rma" style="padding-left: 5px;">&nbsp;'.xtc_draw_pull_down_menu('status',$rma_status,'','style="width:545px;"').'</td>
			       </tr>
			      </table> 
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			       <tr>
			        <td class="header_viewrma">&nbsp;'.RMA_TEXT.'</td>
			        <td class="content_rma" style="padding-left: 6px;">&nbsp;'.xtc_draw_pull_down_menu('text', $load_text,'','style="width:545px;"').'&nbsp;<input type="button" class="button" style="position:relative;top:-5px;" value="'.TEXT_SAVE.'" onclick="this.form.comments.value = this.form.text.value" /></td>
			       </tr>
			      </table>
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			       <tr>
			        <td class="header_viewrma" style="vertical-align: top;">&nbsp;'.RMA_COMMENT.'</td>
			        <td class="content_rma" style="padding-left: 4px;">&nbsp;'.xtc_draw_textarea_field('comments', 'soft', '88', '6', '').'</td>
			       </tr>
			      </table>
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			       <tr>
			        <td class="header_viewrma">&nbsp;'.RMA_MESSAGE.'</td>
			        <td class="content_rma" style="padding-left: 3px;">
			            <table>
			              <tbody>
			                <tr>
			            	  <td>'.xtc_draw_selection_field('comments_send', 'checkbox', '1', 'checked="checked"').'</td>
			            	  <td>'.RMA_COMMENT_SEND.'</td>
			            	  <td style="padding-left:20px;">'.xtc_draw_selection_field('mail_send', 'checkbox', '1', 'checked="checked"').'</td>
			            	  <td>'.RMA_MAIL_SEND.'</td>
			            	  <td></td>
			                </tr>
			              </tbody>
			            </table>
			        </td>
			       </tr>
			      </table>
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			       <tr>
			        <td align="right"><input type="submit" class="button" value="'.RMA_UPDATE.'" onClick="return confirm(\''.UPDATE_ENTRY.'\')"></td>
			       </tr>
			      </table>
			      </form>
		      </td>
		      <td class="boxRight">
				<table class="contentTable">
				  <tbody>
				    <tr class="infoBoxHeading">
				      <td class="infoBoxHeading"><div class="infoBoxHeadingTitle"><b>'.RMA_STATISTIC.'</b></div></td>
				    </tr>
				  </tbody>
				</table>
				<table class="contentTable">
				  <tbody>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent">';
				    	$statistic_query = xtc_db_query("SELECT rma_comments_id, rma_status_id, comments, edit_date FROM ".TABLE_RMA_COMMENTS." WHERE rma_id = '".$show_orders['rma_id']."' ORDER BY rma_comments_id DESC");
						$i=0;
						if (xtc_db_num_rows($statistic_query) > 0) {
							echo '
							<table border="0" cellspacing="1" cellpadding="2" width="100%" >
							  <tr class="dataTableHeadingRow">
								<td class="dataTableHeadingContent">'.TABLE_HEADING_DATE_EDIT.'</td>
								<td class="dataTableHeadingContent">'.TABLE_HEADING_STATUS.'</td>
								<td class="dataTableHeadingContent">'.RMA_COMMENT.'</td>
							  </tr>';
							  while ($statistic = xtc_db_fetch_array($statistic_query)) {
								echo '<tr class="dataTableRow2" onmouseover="this.className=\'dataTableRowOver2\';this.style.cursor=\'pointer\'" onmouseout="this.className=\'dataTableRow2\'" >
								       <td class="go_rma" valign="top">'.xtc_datetime_short($statistic['edit_date']).'</td>
								       <td class="go_rma" valign="top">'.sb_get_status($statistic['rma_status_id']).'</td>
								       <td class="go_rma" valign="top" >'.$statistic['comments'].'</td>
								      </tr>';
								$i++;
							  }
							echo '</table>';
						} else {
							echo '<div>'.NO_STATS.'</div>';
						}
						echo ' 
				    </td>
				  </tr>
				</table>
		      </td>
		    </tr>
		  </tbody>
		</table>';


