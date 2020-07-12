// $Id: readme.txt,v 1.03 2006/04/21 20:40:00 fox Exp $
// Cafepress Shop module for Xoops
// Version 1.03
// Author: Michel Barakat aka Fox | The Fox Blog (http://www.thefoxblog.com/)
// License: GNU General Public License (GPL)
// Project Web Page: http://dev.xoops.org/modules/xfmod/project/?cafepress

Module description :
--------------------

  Cafepress Shop is a small module which allows a holder of a Cafepress.com Basic Store to display his products
as part of his Xoops web site. The store will actually be embedded to the Xoops web interface as if the store
is directly hosted on the web site. The module also includes a block which displays a random product from the
store with the possibility to show or hide the price and description of the product.
  Holders of a Cafepress.com Premium Store can still use this module, with limited features, by setting the Fail
Safe Mode On from the administration menu.


Installation :
--------------

  Cafepress Shop module is installed as any other Xoops module, you first have to copy the folder "cafepress" to 
your "xoops_url/modules/" directory. Then install the module from the administration section.


Feedback :
----------

  Your feedback concerning this module is greatly appreciated. If you'd like to report a bug or request an 
improvement or simply discuss the module, please visit the project web page or use the links below:
- Report a bug at http://dev.xoops.org/modules/xfmod/tracker/?group_id=1209&atid=1006
- Request a feature at http://dev.xoops.org/modules/xfmod/tracker/?group_id=1209&atid=1009


Change Log :
------------

Cafepress Shop v1.03 (21 April 2006)
- Fixed several bugs resulting from changes on the Cafepress.com web site
- Added a Fail Safe Mode option, which enables or disables the item page
- Added a check update feature. When a new version is release, you'll receive a message in the administration menu

Cafepress Shop v1.02 (17 Obtober 2005)
- Fixed a bug in the "Shop Product" block: sometimes, no item was shown in the block
- An additional item page was added: users can now view the product information page on your xoops web site.
- Module is now only suitable for Basic Cafepress.com accounts. Holders of Premium Cafepress.com accounts will not
be able to use it properly. However, they can still use Cafepress Shop v1.01
- Module is not anymore XHTML 1.0 Compliant at 100 % (the item page in particular)

Cafepress Shop v1.01 (14 March 2005)
- Fixed some PHP Debug mode Warnings / Notices

Cafepress Shop v1.0 (05 March 2005)
- Initial release


Special Thanks :
----------------

theCat (http://theCat.ouvaton.org/) for the manual "Guide pour la création d’un module Xoops 2.x"
herve (http://www.herve-thouzard.com/) for the "getModuleOption" code snippet