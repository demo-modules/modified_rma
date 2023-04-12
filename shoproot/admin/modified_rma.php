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

    include('includes/application_top.php');
	
	// include needed functions
	require_once(DIR_FS_INC.'xtc_php_mail.inc.php');
	require_once(DIR_FS_INC.'sb_get_reasons.inc.php');
	require_once(DIR_FS_INC.'sb_get_rma_status.inc.php');
	
	// include needed classes
	require (DIR_WS_CLASSES.'order.php');
	
	// get languages
	$languages = xtc_get_languages();
	$lang = sizeof($languages);
	
	// create new Smarty instance
	$smarty = new Smarty;
	$smarty->assign('language', $_SESSION['language']);
	$smarty->caching = false;
	
	// load text in text area
	$load_text = array();
	for($a = 0; $a < COUNT_TEXT_ORDERS; $a++){
	  $title = @constant('TEXT_ORDERS_TITLE_'.$a);
	  $text = @constant('TEXT_ORDERS_TEXT_'.$a);
	  $load_text[] = array('id' => $text, 'text' => $title);
	}
	
	// RMA status arrays
	$rma_status = array();
	$rma_status_select = array();
	$rma_status_array = array();
	$change_rma = array();
	
	// RMA CHANGE
	$change_rma[] = array('id' => 0, 'text' => TABLE_FOOTER_ACTION_0);
	$change_rma[] = array('id' => 1, 'text' => TABLE_FOOTER_ACTION_DELETE_ALL);
	
	$rma_status_select[] = array('id' => 0, 'text' => TABLE_HEADING_SELECT_ALL);

	$rma_status_query = xtc_db_query("SELECT rma_status_id, rma_status_name FROM ".TABLE_RMA_STATUS." WHERE language_id = '".(int)$_SESSION['languages_id']."'");
		
	while($rma = xtc_db_fetch_array($rma_status_query)){
		$rma_status[] = array('id' => $rma['rma_status_id'], 'text' => $rma['rma_status_name']);
		$rma_status_array[$rma['rma_status_id']] = $rma['rma_status_name'];
		$rma_status_select[] = array('id' => $rma['rma_status_id'], 'text' => $rma['rma_status_name']);
	}	

    $action = ((isset($_GET['action'])) ? $_GET['action'] : '');
    
    include (DIR_WS_MODULES.'modified_rma/actions.php');
  
    require (DIR_WS_INCLUDES.'head.php');
?>
<link rel="stylesheet" property="stylesheet" href="includes/css/rma-style.css" type="text/css" media="screen" />
</head>
<body>
  <!-- header //-->
  <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
  <!-- header_eof //-->
  <!-- body //-->
  <table class="tableBody">
    <tr>
      <?php //left_navigation
      if (USE_ADMIN_TOP_MENU == 'false') {
        echo '<td class="columnLeft2">'.PHP_EOL;
        echo '<!-- left_navigation //-->'.PHP_EOL;       
        require_once(DIR_WS_INCLUDES . 'column_left.php');
        echo '<!-- left_navigation eof //-->'.PHP_EOL; 
        echo '</td>'.PHP_EOL;      
      }
      ?>
      <!-- body_text //-->
    <td class="boxCenter" width="100%" valign="top">
    
        <div class="pageHeadingImage"><?php echo xtc_image(DIR_WS_ICONS.'heading/icon_orders.png', RMA_HEADING_TITLE); ?></div>
        <div class="pageHeading pdg2 flt-l"><?php echo RMA_HEADING_TITLE; ?>
          <div class="main pdg2"><?php echo BOX_HEADING_XTC_TOOL_RMA; ?></div> 
        </div> 
        <?php if (!isset($_GET['action'])) { ?>
        <div class="smallText pdg2 flt-r">
         	<?php echo xtc_draw_form('sort_rma',FILENAME_RMA, 'action=sort', '','get');
               echo '<b>'.TABLE_HEADING_STATUS.'</b>: '.xtc_draw_pull_down_menu('sort', $rma_status_select, '', 'onchange="this.form.submit();" style="width:180px;"');
               echo '</form>'; 
            ?>
        </div>
        <?php } ?>
        <div class="clear"></div> 
        
        <?php
          $tab_array = array('showrma');
          
          switch ($action) {
            case 'newrma': 
            case 'change_reason':         
            case 'showrma':         
            default:         
              echo '<div class="configPartner cf">
                      <a class="configtab'.((isset($_GET['action']) && in_array($_GET['action'], $tab_array) || !isset($_GET['action'])) ? ' activ' : '').'" href="'.xtc_href_link(FILENAME_RMA, '', 'NONSSL').'">'.((isset($_GET['action']) && $_GET['action'] == 'showrma') ? TABLE_HEADING_SETTINGS_EDIT : TABLE_HEADING_SETTINGS_NAVI_OVERVIEW).'</a>
                      <a class="configtab'.((isset($_GET['action']) && $_GET['action'] == 'newrma') ? ' activ' : '').'" href="'.xtc_href_link(FILENAME_RMA, 'action=newrma', 'NONSSL').'">'.TABLE_HEADING_SETTINGS_NEW_RMA.'</a>
                      <a class="configtab'.((isset($_GET['action']) && $_GET['action'] == 'change_status') ? ' activ' : '').'" href="'.xtc_href_link(FILENAME_RMA, 'action=change_status', 'NONSSL').'">'.TABLE_HEADING_SETTINGS_STATUS.'</a>
                      <a class="configtab'.((isset($_GET['action']) && $_GET['action'] == 'change_reason') ? ' activ' : '').'" href="'.xtc_href_link(FILENAME_RMA, 'action=change_reason', 'NONSSL').'">'.TABLE_HEADING_SETTINGS_REASON.'</a>
                    </div>';

              echo '<div class="configPartner content">';
              break;
          }
            
          switch ($action) {
            case 'change_reason':        
			    include (DIR_WS_MODULES.'modified_rma/change_reason.php');
	            break;
            case 'change_status':
			    include (DIR_WS_MODULES.'modified_rma/change_status.php');
                break;        
            case 'newrma':        
			    include (DIR_WS_MODULES.'modified_rma/newrma.php');
	            break;
            case 'showrma':        
			    include (DIR_WS_MODULES.'modified_rma/showrma.php');
	            break;
            default: 
			    include (DIR_WS_MODULES.'modified_rma/default.php');
                break;        
          }
          echo '</div>';
          ?>
        </td>
      </tr>
    </table>
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <br />
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
