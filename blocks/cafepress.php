<?php
// $Id: cafepress.php,v 1.03 2006/04/21 20:40:00 fox Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Michel Barakat aka Fox | The Fox Blog (http://www.thefoxblog.com/)

include_once XOOPS_ROOT_PATH.'/modules/cafepress/include/functions.php';

   // Displays block interface
   function b_cafepress_show($options)
   {
      global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;
      $block = array();
      $block['title'] = _MB_CAFEPRESS_TITLE1;
      $shop = cafePressUtils::getModuleOption('storename');
	  $mode = cafePressUtils::getModuleOption('mode');
      $path = $xoopsConfig['xoops_url'] . "/modules/cafepress";
      $block['content'] = cafePressUtils::displayBlock($shop, $mode, $path, $options[0], $options[1], $options[2]);
	
	return $block;
   }

   // Editable block options
   function b_cafepress_edit($options)
   {
      $form = ""._MB_CAFEPRESS_SIZE."&nbsp;<input type=\"text\" name=\"options[]\" value=\"".$options[0]."\"/>&nbsp;"._MB_CAFEPRESS_NOTE."<br />";

      $chk = "";
      $form .= _MB_CAFEPRESS_DESHOW."&nbsp;";
      if ( $options[1] == 1 ) {
         $chk = " checked='checked'";
      }
      $form .= "<input type='radio' name='options[1]' value='1'".$chk." />&nbsp;"._MB_CAFEPRESS_YES;
      $chk = "";
      if ( $options[1] == 0 ) {
         $chk = ' checked="checked"';
      }
      $form .= '&nbsp;<input type="radio" name="options[1]" value="0"'.$chk.' />'._MB_CAFEPRESS_NO."<br />";

      $chk = "";
      $form .= _MB_CAFEPRESS_PRSHOW."&nbsp;";
      if ( $options[2] == 1 ) {
         $chk = " checked='checked'";
      }
      $form .= "<input type='radio' name='options[2]' value='1'".$chk." />&nbsp;"._MB_CAFEPRESS_YES;
      $chk = "";
      if ( $options[2] == 0 ) {
         $chk = ' checked="checked"';
      }
      $form .= '&nbsp;<input type="radio" name="options[2]" value="0"'.$chk.' />'._MB_CAFEPRESS_NO;

      return $form;
   }

?>