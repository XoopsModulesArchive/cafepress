<?php
// $Id: index.php,v 1.01 2006/04/21 20:40:00 fox Exp $
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

include '../../../include/cp_header.php';
include '../include/functions.php';
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/include/xoopscodes.php";
include_once XOOPS_ROOT_PATH.'/class/module.errorhandler.php';

$myts =& MyTextSanitizer::getInstance();
$eh = new ErrorHandler;

// Site language (default is english)
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") )
{
   include "../language/".$xoopsConfig['language']."/main.php";
}

else
{
   include "../language/english/main.php";
}

// Displays admin interface
function showAdmin()
{
   global $xoopsDB, $xoopsModule;
   xoops_cp_header();

   echo "<h4>" . _AM_CAFEPRESS_CONFIG . "</h4>";
   echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
   echo " - <a href='" . XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule -> getVar( 'mid' ) . "'>" . _AM_CAFEPRESS_PREFERENCES . "</a><br /><br />\n";
   echo "- <strong>" . _AM_CAFEPRESS_UPDATE . ":</strong> ";
   
   // Check latest version
   $version = cafePressUtils::checkUpdate();
   if ($version == "-1")
   { 
	  echo _AM_CAFEPRESS_UPDATE_ERROR;
   }
   else
   {
	  if ($version == "1.03")
	  {
	    echo _AM_CAFEPRESS_UPDATE_NO;
	  }
	  else
	  {
	    echo _AM_CAFEPRESS_UPDATE_YES;
	  }
   }   

   echo"</td></tr></table>";
   
   xoops_cp_footer();
}

// Function selector
if (!isset($_POST['op']))
{
   $op = isset($_GET['op']) ? $_GET['op'] : 'main';
}

else
{
   $op = $_POST['op'];
}

switch ($op)
{
   default:
   showAdmin();
   break;
}

?>