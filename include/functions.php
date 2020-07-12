<?php
// $Id: functions.php,v 1.04 2006/04/21 20:40:00 fox Exp $
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

class cafePressUtils
{
   /**
   * Displays the Cafepress "Shop Product" block
    *
    * Returns the HTML code for the Cafepress Shop Product block
    *
    * @param string $store	the store name
    * @param int $mode	the safe mode flag
    * @param string $path	the module full path
    * @param int $width	the image product width
    * @param int $description	show description status (0 = no, 1 = yes)
    * @param int $price	show price status (0 = no, 1 = yes)
    */
   function displayBlock($store, $mode, $path, $width, $description, $price)
   {
      $block = cafePressUtils::getShop($store);
	  
	  if ($mode == 0)
	  {
		$block = ereg_replace("<a href=\"/", "<a target=\"_blank\" href=\"item.php?id=", $block);
	  }
	  else
	  {
		$block = ereg_replace("<a href=\"/", "<a target=\"_blank\" href=\"http://www.cafepress.com/", $block);
	  }	  
	  
      $block = cafePressUtils::getProduct($block);
	  $width = "height=\"" . $width . "\"";
      $block = ereg_replace("height=\"150\"", $width, $block);

      $block = ereg_replace("item.php", $path . "/item.php", $block);
      
      if ($description == 0)
      {
         $block = ereg_replace("<br /><a target", "<!-- <br /><a target", $block);

         if ($price == 0)
         {
            $block = ereg_replace("</center>", " --></center>", $block);
         }         
         else
         {
            $block = ereg_replace("</a><br />", "</a> --><br />", $block);         
         }
      }
      else
      {
         if ($price == 0)
         {
            $block = ereg_replace("</a><br /><a target", "tempspace", $block);
            $block = ereg_replace("</a><br />", "</a><!-- <br />", $block);
            $block = ereg_replace("tempspace", "</a><br /><a target", $block);
            $block = ereg_replace("</center>", " --></center>", $block);
         }
      }
      
      $block = ereg_replace(" target=\"_blank\"", "", $block);

      return $block;
   }

   /**
    * Displays the Cafepress module
    *
    * Returns the HTML code for the Cafepress module homepage
    *
    * @param string $store	the store name
    * @param int $mode		the safe mode flag
    */
   function displayModule($store, $mode)
   {
      $module = cafePressUtils::getShop($store);

	  if ($mode == 0)
	  {
		$module = ereg_replace("<a href=\"/", "<a target=\"_blank\" href=\"item.php?id=", $module);
	  }
	  else
	  {
		$module = ereg_replace("<a href=\"/", "<a target=\"_blank\" href=\"http://www.cafepress.com/", $module);
	  }
	  
      $module = ereg_replace(" target=\"_blank\"", "", $module);
      $module = $module . base64_decode(cafePressUtils::getKey());
      $module = ereg_replace("</table><br />", "</table>", $module);

      return $module;
;
   }

   /**
    * Displays a Cafepress item
    *
    * Returns the HTML code for the Cafepress item
    *
    * @param string $item	the item id
    */
   function displayItem($item)
   {
      $reqheader = "GET /$item HTTP/1.0\r\nHost: www.cafepress.com\r\nUser-Agent: MS Internet Explorer\r\n\r\n"; 
      $socket = @fsockopen("www.cafepress.com", 80, $errno, $errstr);
      $cpfile = "";

      if ($socket) 
      { 
         fputs($socket, $reqheader);

         while (!feof($socket)) 
         { 
               $cpfile .= fgets($socket, 4096);
         } 
      }
       
      fclose($socket);
	  
	  // Title
	  $from = "<!-- Product Name/Caption -->";
	  $to = "<!-- /Product Name/Caption -->";
      eregi("$from(.*)$to", $cpfile, $cptitle);
	  $title = $cptitle[1];	  
	  
	  $title = ereg_replace("<div id=\"productCaption\" class=\"pageTitle head\">", "<strong>", $title);
	  $title = ereg_replace("</div>", "</strong>", $title);
	  
	  // Price
      $from = "<div id=\"ordering\">";
      $to = "<!-- /Ordering -->";
      eregi("$from(.*)$to", $cpfile, $cprice);
	  $price = $cprice[1];
	  $price = "<div>" . $price;

	  $price = ereg_replace(" class=\"xsmallText\"", "", $price);
	  $price = ereg_replace(" class=\"signup\"", "", $price);
	  $price = ereg_replace("background-color:#FFF4CA;", "", $price);
	  
	  // Description
      $from = "<div id=\"productInfo\">";
      $to = "<!-- /Sales And Promotions -->";
      eregi("$from(.*)$to", $cpfile, $cdesc);
	  $desc = $cdesc[1];
	  $desc = "<div>" . $desc . "</div>";	  
	  
	  // Image
      $from = "<td align=\"center\" width=\"240\">";
      $to = "<!-- Product Swatches -->";
      eregi("$from(.*)$to", $cpfile, $cimage);
	  $image = $cimage[1];
	  $image = ereg_replace(" class=\"xsmallText\"", "", $image);
	  $image = ereg_replace(" class=\"imageborder\"", "", $image);
	  $image = ereg_replace("height=\"6\"", "height=\"0\"", $image);
	  
	  // Shop
	  $shop = "<script language=\"JavaScript1.1\" src=\"/cp/bin/commonscripts.js\"></script>\n";
	  $shop = $shop . $title . "<br /><table border=\"0\"><tr><td>" . $image . "</td><td>" . $price . "</td></tr></table>" . "<br />" . $desc;
	  
	  $shop = $shop . base64_decode(cafePressUtils::getKey());
	  $shop = ereg_replace("/cp/", "http://www.cafepress.com/cp/", $shop);
	  $shop = ereg_replace("/content/", "http://www.cafepress.com/content/", $shop);
	  $shop = ereg_replace("â€™", "'", $shop);
      $shop = ereg_replace("â€", "\"", $shop);
      $shop = ereg_replace("nquot;", "\"", $shop);
      $shop = ereg_replace("<span>", "", $shop);
      $shop = ereg_replace("</span>", "", $shop);
	  
	  return $shop;
   }

   /**
    * Gets the Cafepress shop
    *
    * Returns the HTML code of the Cafepress.com shop
    *
    * @param string $store	the store name
    */
   function getShop($store)
   {
      $from = '<!-- ### Items ### -->';
      $to = '<!-- ### end of ITEMS ### -->';
      $url = 'http://www.cafepress.com/' . $store;

      $reqheader = "GET /$store HTTP/1.0\r\nHost: www.cafepress.com\r\nUser-Agent: MS Internet Explorer\r\n\r\n"; 
      $socket = @fsockopen("www.cafepress.com", 80, $errno, $errstr);
      $cpfile = "";

      if ($socket) 
      { 
         fputs($socket, $reqheader); 
  
         while (!feof($socket)) 
         { 
               $cpfile .= fgets($socket, 4096);
         } 
      }
       
      fclose($socket);

      $items = eregi("$from(.*)$to", $cpfile, $cparray);

      $shop = ereg_replace("<span class=\"head\">", "", $cparray[1]);
      $shop = ereg_replace("</span>", "", $shop);
      $shop = ereg_replace("</td><td width=\"90%\"><span class=\"storesmallprint\"></td><td nowrap><span class=\"storesmallprint\"><a href=\"#top\">Back to Top</a>", "", $shop);
      $shop = ereg_replace("class=\"imageborder\" ", "", $shop);
      $shop = ereg_replace("<br>", "<br />", $shop);
      $shop = ereg_replace(".jpg\">", ".jpg\" />", $shop);
      $shop = ereg_replace("<tr></tr>", "", $shop);
      $shop = ereg_replace("colspan=3", "colspan=\"3\"", $shop);
      $shop = ereg_replace("&nbsp;&nbsp;&nbsp;</td>", "1<tempspace>1", $shop);
      $shop = ereg_replace("<hr size=\"1\"></td>", "2<tempspace>2", $shop);
      $shop = ereg_replace("</table></td>", "3<tempspace>3", $shop);
      $shop = ereg_replace("</td>", "</p></td>", $shop);
      $shop = ereg_replace("1<tempspace>1", "</td>", $shop);
      $shop = ereg_replace("2<tempspace>2", "<hr size=\"1\" /></td>", $shop);
      $shop = ereg_replace("3<tempspace>3", "</table></td>", $shop);
      $shop = ereg_replace("</td></tr><tr>", "tempspace4", $shop);
      $shop = ereg_replace("</tr><tr>", "<td></td></tr><tr>", $shop);
      $shop = ereg_replace("tempspace4", "</td></tr><tr>", $shop);
      $shop = ereg_replace("nowrap", "nowrap=\"nowrap\"", $shop);
      $shop = ereg_replace(",", "", $shop);
      $shop = ereg_replace("!", "", $shop);
      $shop = ereg_replace("<br style=\"clear: all\" />", "", $shop);
      $shop = ereg_replace(" & ", " tempspace5 ", $shop);
      $shop = ereg_replace("&", "n", $shop);
      $shop = ereg_replace("tempspace5", "&amp;", $shop);
      $shop = ereg_replace("nquot;", "\"", $shop);
      $shop = ereg_replace(" align=\"left\"", "", $shop);

      return $shop;
   }

   /**
    * Gets a random Cafepress product
    *
    * Returns the HTML code of a random product from the Cafepress shop
    *
    * @param string $shop	HTML code of the Cafepress.com shop
    */
   function getProduct($shop)
   {
      $shop = ereg_replace("<table cellpadding=\"8\" border=\"0\" align=\"center\" width=\"100%\">", "", $shop);
      $shop = ereg_replace("<tr>", "", $shop);
      $shop = ereg_replace("</tr>", "", $shop);
      $shop = ereg_replace("<td></td>", "", $shop);
      $shop = ereg_replace("</table>", "", $shop);

	$splitshop = split ("\n", $shop);

	foreach ($splitshop as $line)
      {
	   if (strlen($line) > 10)
         {
            $shoparr[] = $line;
	   }
      }
      
      foreach ($shoparr as $line)
      {
         $line = ereg_replace("<td align=\"center\" valign=\"top\"><p>", "<center>", $line);
         $line = ereg_replace("</p></td>", "</center>", $line);
         $line = ereg_replace("<br /><br />", "<br />", $line);

         if (eregi("<td colspan=\"3\">", $line))
         {
            unset($line);
         }

         if (!empty($line))
         {
            $arr[] = $line;
         }
      }              

      $arr_size = count($arr) - 1;

      if ($arr_size != 0)
      {
         $ran = rand (1, $arr_size);
      }

      return $arr[$ran];
   }

   /**
    * Checks if a new version of Cafepress Shop is available
    *
    * Returns the version 
    */
   function checkUpdate()
   {
      $reqheader = "GET /cpx.dat HTTP/1.0\r\nHost: files.thefoxblog.com\r\nUser-Agent: MS Internet Explorer\r\n\r\n"; 
      $socket = @fsockopen("files.thefoxblog.com", 80, $errno, $errstr);
      $cpfile = "";

      if ($socket) 
      { 
         fputs($socket, $reqheader); 
  
         while (!feof($socket)) 
         { 
               $cpfile .= fgets($socket, 4096);
         } 
      }
       
      fclose($socket);
	  
	  $from = '==';
      $to = '==';  
	  eregi("$from(.*)$to", $cpfile, $cversion);
	  
	  $version = $cversion[1];
	  
	  if (strlen($version) != 4)
	  {
	     $version = "-1";
      }
		
	  return $version;
   }
   
   /**
    * Gets the module's key
    *
    * Returns the cafepress module's key
    */
   function getKey()
   {
      $key  = "PGJyIC8+PGNlbnRlcj48Zm9udCBzaXplPSIxIj4KPGEga";
	  $key .= "HJlZj0iaHR0cDovL2Rldi54b29wcy5vcmcvbW9kdWxlcy";
	  $key .= "94Zm1vZC9wcm9qZWN0Lz9jYWZlcHJlc3MiIHRhcmdldD0";
	  $key .= "iX2JsYW5rIj5DYWZlUHJlc3MgU2hvcCAxLjAzPC9hPiB8";
	  $key .= "IFBvd2VyZWQgYnkgPGEgaHJlZj0iaHR0cDovL3d3dy50a";
	  $key .= "GVmb3hibG9nLmNvbS8iIHRhcmdldD0iX2JsYW5rIj5UaG";
	  $key .= "UgRm94IEJsb2c8L2E+CjwvZm9udD48L2NlbnRlcj4K";
	
      return $key;
   }

   /**
    * Returns a module's option
    *
    * Returns a module's option (for the cafepress module)
    *
    * @param string $option	module option's name
    */
   function getModuleOption($option)
   {
      global $xoopsModuleConfig, $xoopsModule;
      static $tbloptions= Array();
      $repmodule = 'cafepress';

      if (is_array($tbloptions) && array_key_exists($option,$tbloptions))
      {
         return $tbloptions[$option];
      }

      $retval=false;

      if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive')))
      {
         if (isset($xoopsModuleConfig[$option]))
         {
            $retval= $xoopsModuleConfig[$option];
         }
      }      
      else
      {
         $module_handler =& xoops_gethandler('module');
         $module =& $module_handler->getByDirname($repmodule);
         $config_handler =& xoops_gethandler('config');

         if ($module)
         {
            $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));

            if (isset($moduleConfig[$option]))
            {
               $retval = $moduleConfig[$option];
            }
         }
      }
      
      $tbloptions[$option]=$retval;
      return $retval;
   }
}
?>