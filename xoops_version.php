<?php
// $Id: xoops_version.php,v 1.04 2006/04/21 20:40:00 fox Exp $
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

// Module
$modversion['name'] = _MI_CAFEPRESS_NAME;
$modversion['version'] = 1.03;
$modversion['description'] = _MI_CAFEPRESS_DESC;
$modversion['credits'] = "The Fox Blog (http://www.thefoxblog.com/)";
$modversion['author'] = "Michel Barakat aka Fox";
$modversion['help'] = "";
$modversion['license'] = "GNU General Public License (GPL)";
$modversion['official'] = 1;
$modversion['image'] = "cafepress.png";
$modversion['dirname'] = "cafepress";

// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";

// Blocks
$modversion['blocks'][1]['file'] = "cafepress.php";
$modversion['blocks'][1]['name'] = _MI_CAFEPRESS_BNAME1;
$modversion['blocks'][1]['description'] = "Shows a random item from the Cafepress Shop";
$modversion['blocks'][1]['show_func'] = "b_cafepress_show";
$modversion['blocks'][1]['edit_func'] = "b_cafepress_edit";
$modversion['blocks'][1]['options'] = "150|1|1|1";

// Menu
$modversion['hasMain'] = 1;

// Options
$modversion['config'][1]['name'] = 'storename';
$modversion['config'][1]['title'] = '_MI_CAFEPRESS_OPT1';
$modversion['config'][1]['description'] = '_MI_CAFEPRESS_OPT1_DSC';
$modversion['config'][1]['formtype'] = 'texbox';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = 'beitmery';

$modversion['config'][2]['name'] = 'mode';
$modversion['config'][2]['title'] = '_MI_CAFEPRESS_OPT2';
$modversion['config'][2]['description'] = '_MI_CAFEPRESS_OPT2_DSC';
$modversion['config'][2]['formtype'] = 'yesno';
$modversion['config'][2]['valuetype'] = 'int';
$modversion['config'][2]['default'] = '0';
?>