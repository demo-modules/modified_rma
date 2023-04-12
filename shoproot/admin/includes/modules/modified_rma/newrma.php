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
		      <td class="boxCenterLeft">';
				  if (sizeof($products_ids) == 0) {
					echo xtc_draw_form('product_search', FILENAME_RMA, 'action=newrma','post','');
				  } elseif (sizeof($customers_ids) == 0) {
					echo xtc_draw_form('customer_search',FILENAME_RMA, 'action=newrma','post','');
				  } else {
					echo xtc_draw_form('edit_rma',FILENAME_RMA, 'action=newrma_insert','post','');
				  }	
				  echo '
			      <div class="heading"><strong>'.TABLE_HEADING_SETTINGS_NAVI_OVERVIEW.'</strong></div>
			      <table width="100%" border="0" cellspacing="1" cellpadding="2">
			        <tbody>
			          <tr>
			            <td valign="top" width="50%">
					      <table width="100%" border="0" cellspacing="1" cellpadding="2">
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_CUSTOMERS.'</td>';
							if (sizeof($customers_ids) == 0) {
							  echo '<td class="content_rma" style="padding-left: 4px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td>' . xtc_draw_input_field('customer_keyword', '', 'size="40"') . '</td><td><input type="submit" class="button" style="position:relative;top:-2px;" onClick="this.blur();" value="' . BUTTON_PRODUCT_SEARCH . '"/></td></tr></table></td>';
							} else {	
							  echo '<td class="content_rma" style="padding-left: 4px;">' . xtc_draw_pull_down_menu('customers_id', $customers_ids, isset($_GET['customer']) ? $_GET['customer'] : '', 'style="width:320px;"').'</td>';
							}
							echo '
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_PRODUCT.'</td>';
							if (sizeof($products_ids) == 0) {
							  echo '<td class="content_rma" style="padding-left: 4px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td>' . xtc_draw_input_field('keyword', '', 'size="40"') . '</td><td><input type="submit" class="button" style="position:relative;top:-2px;" onClick="this.blur();" value="' . BUTTON_PRODUCT_SEARCH . '"/></td></tr></table></td>';
							} else {	
							  echo '<td class="content_rma" style="padding-left: 4px;">' . xtc_draw_pull_down_menu('products_id', $products_ids, isset($_GET['product']) ? $_GET['product'] : '', 'style="width:320px;"').'</td>';
							}
							echo '
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_PRODUCTS_EAN.'</td>
					        <td class="content_rma">'.xtc_draw_input_field('products_ean', isset($_GET['ean']) ? $_GET['ean'] : '', 'size="50"').'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_RMA_NR.'</td>
					        <td class="content_rma">'.xtc_draw_hidden_field('rma_id', isset($next_rma_id['next_id']) ? $next_rma_id['next_id'] : '1').xtc_draw_input_field('rma_id_fake', isset($next_rma_id['next_id']) ? $next_rma_id['next_id'] : '1', 'size="5" disabled="disabled"').TEXT_SYSTEM_INFO_RMA.'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_DATE.'</td>
					        <td class="content_rma">&nbsp;'.xtc_datetime_short(date("Y.m.d H:i:s")).'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TABLE_HEADING_ORDER_ID.'</td>
					        <td class="content_rma" style="padding-left: 4px;">'.xtc_draw_pull_down_menu('orders_id', $order_ids, isset($_GET['order']) ? $_GET['order'] : '', 'style="width:320px;"').'</td>
					       </tr>
					      </table>
			            </td>
			            <td valign="top" width="50%">
					      <table width="100%" border="0" cellspacing="1" cellpadding="2">
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_SHIPPING_TIME.'</td>
					        <td class="content_rma">'.xtc_draw_input_field('shipping_time', isset($_GET['shipping_time']) ? $_GET['shipping_time'] : '', 'size="38"').'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_IF_PICKUP.'</td>
					        <td class="content_rma">&nbsp;'.xtc_draw_radio_field('pickup', '1').'&nbsp;'.TEXT_PICKUP_YES.'&nbsp;&nbsp;'.xtc_draw_radio_field('pickup', '0', 'checked="checked"').'&nbsp;'.TEXT_PICKUP_NO.'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_IF_COST_ESTIMATE.'</td>
					        <td class="content_rma">&nbsp;'.xtc_draw_radio_field('cost_estimate', '1').'&nbsp;'.TEXT_COAST_ESTIMATE_YES.'&nbsp;&nbsp;'.xtc_draw_radio_field('cost_estimate', '0', 'checked="checked"').'&nbsp;'.TEXT_COAST_ESTIMATE_NO.'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma">&nbsp;'.TEXT_RMA_REASON.'</td>
					        <td class="content_rma">'.xtc_draw_pull_down_menu('reason_id', sb_get_reasons(), isset($_GET['reason_id']) ? $_GET['reason_id'] : '', 'style="width:320px;"').'</td>
					       </tr>
					       <tr>
					        <td class="header_viewrma" valign="top">&nbsp;'.TEXT_DESCRIPTION.'</td>
					        <td class="content_rma" style="padding-left:4px;">'.xtc_draw_textarea_field('description', 'soft', '80', '4', '', 'style="width:98%"').'</td>
					       </tr>
					      </table>
			            </td>
			          </tr>
			        </tbody>
			      </table>';
				  if (sizeof($products_ids) == 0) {
					echo '</form>';
				  } elseif (sizeof($customers_ids) == 0) {
					echo '</form>';
				  }
				  echo '
			      <br /><br />
			      <div class="heading"><strong>'.RMA_OPTIONS.'</strong></div>
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
			        <td align="right"><input type="submit" class="button" style="position:relative;top:-5px;" value="'.RMA_UPDATE.'" onClick="return confirm(\''.UPDATE_ENTRY.'\')"></td>
			       </tr>
			      </table>
			      </form>
		      </td>
		      <td class="boxRight">
				<table class="contentTable">
				  <tbody>
				    <tr class="infoBoxHeading">
				      <td class="infoBoxHeading"><div class="infoBoxHeadingTitle"><b>'.RMA_NOTICE_HEADLINE.'</b></div></td>
				    </tr>
				  </tbody>
				</table>
				<table class="contentTable">
				  <tbody>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent"><div style="padding-top: 5px; font-weight: bold; width: 100%;">'.RMA_NOTICE_1.'</div></td>
				  </tr>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent"><div style="padding-top: 5px; font-weight: bold; width: 100%; margin-top: 5px;">'.RMA_NOTICE_2.'</div></td>
				  </tr>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent"><div style="padding-top: 5px; font-weight: bold; width: 100%; margin-top: 5px;">'.RMA_NOTICE_3.'</div></td>
				  </tr>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent"><div style="padding-top: 5px; font-weight: bold; width: 100%; margin-top: 5px;">'.RMA_NOTICE_4.'</div></td>
				  </tr>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent"><div style="padding-top: 5px; font-weight: bold; width: 100%; margin-top: 5px;">'.RMA_NOTICE_5.'</div></td>
				  </tr>
				  </tbody>
				</table>
		      </td>
		    </tr>
		  </tbody>
		</table>';




