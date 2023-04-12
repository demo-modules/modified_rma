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

  echo '<table class="clear tableCenter collapse">
		  <tbody>
		    <tr>
		      <td class="boxCenterLeft">
					<div class="heading"><strong>'.TABLE_HEADING_SETTINGS_STATUS.'</strong></div>';
					echo xtc_draw_form('rma_status', FILENAME_RMA, 'action=change_status_update','post','').'
					<table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">';
					$count_languages = sizeof($languages);
					$status_id_array = array();
					$count_status_items_query = xtc_db_query("SELECT DISTINCT rma_status_id FROM " . TABLE_RMA_STATUS);
					while($count_status_items = xtc_db_fetch_array($count_status_items_query)){
						$status_id_array[] = array('id' => $count_status_items['rma_status_id']);
					}
					$count_status_array = count($status_id_array);
					for($a = 0; $a < $count_status_array; $a++) {
						for($i = 0; $i < $count_languages; $i++) {
							$show_status_query = xtc_db_query("SELECT rma_status_id, language_id, rma_status_name FROM " . TABLE_RMA_STATUS." WHERE language_id = '".$languages[$i]['id']."' AND rma_status_id = '".$status_id_array[$a]['id']."'");
							$change_status = xtc_db_fetch_array($show_status_query);
							echo '
						    <tr>
						     <td class="header_viewrma">&nbsp;<b>'.xtc_image(DIR_WS_LANGUAGES.$languages[$i]['directory'].'/admin/images/'.$languages[$i]['image']).'&nbsp;&nbsp;'.$languages[$i]['name'].'</b></td>
						     <td class="content_rma">'.xtc_draw_hidden_field('rma_status_id[]',$change_status['rma_status_id']).xtc_draw_input_field('rma_status_name['.$languages[$i]['id'].']['.$status_id_array[$a]['id'].']', $change_status['rma_status_name'],'size="50"').'</td>';
							 if ($change_status['language_id'] == $count_languages) {			
						       echo '<td rowspan="'.$count_languages.'">&nbsp;'.xtc_draw_selection_field('delete[]', 'checkbox', $status_id_array[$a]['id']).TEXT_STATUS_DELETE.'</td>';
							 }
				    		echo '
				    		</tr>';
						}
			    		echo '
				    		<tr>
				    		  <td colspan="3">&nbsp;</td>
				    		</tr>';
					}
					echo '  <tr>
						     <td colspan="3"><input class="button" type="submit" value="'.TEXT_UPDATE.'"></td>
						    </tr>
						   </table></form> 
		      </td>
		      <td class="boxRight">
				<table class="contentTable">
				  <tbody>
				    <tr class="infoBoxHeading">
				      <td class="infoBoxHeading"><div class="infoBoxHeadingTitle"><b>'.TABLE_HEADING_SETTINGS_STATUS_NEW.'</b></div></td>
				    </tr>
				  </tbody>
				</table>
				<table class="contentTable">
				  <tbody>
				  <tr class="infoBoxContent">
				    <td class="infoBoxContent">';
						echo xtc_draw_form('rma_status', FILENAME_RMA, 'action=new_status','post','').'
						<table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">';
						  for ($i = 0; $i < $count_languages; $i ++) {
					      echo '
					      <tr>
					       <td class="go_rma" width="140">&nbsp;<b>'.xtc_image(DIR_WS_LANGUAGES.$languages[$i]['directory'].'/admin/images/'.$languages[$i]['image']).'&nbsp;&nbsp;'.$languages[$i]['name'].'</b></td>
					       <td class="content_rma">'.xtc_draw_input_field('rma_status_name['.$languages[$i]['id'].']','','size="50"').'</td>
					      </tr>';
						  }
						  echo '
						  <tr>
						   <td colspan="2" align="right"><input class="button" type="submit" value="'.TEXT_SAVE.'"></td>
						  </tr>
						</table>
						</form>
				    </td>
				  </tr>
				</table>
		      </td>
		    </tr>
		  </tbody>
		</table>';

