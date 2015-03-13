/*
   Milonic DHTML Menu Frames Based Navigation Module  mm_navframe.js version 1.0 - March 22 2005
   Written by Kevin Clements
   This module is only compatible with the Milonic DHTML Menu version 5.62 or higher

   Copyright 2005 (c) Milonic Solutions Limited. All Rights Reserved.
   This is a commercial software product, please visit http://www.milonic.com/ for more information.
   
   This code should be loaded into the "nav" or "navigation" frame, where the Main Menu will be displayed.
*/

function openSubmenuInFrame()
{
  var selectedItem = _itemRef;
  var submenuToOpen = _mi[selectedItem][3];
  var targetFrame = _mi[selectedItem][35];
  var mainOrientation = _m[_mi[_itemRef][0]][9]; // 0 = vert, 1 = horiz
  selectedItemPos = gpos(gmobj("el" + selectedItem));
  parent.frames[targetFrame].openSubmenu(submenuToOpen, selectedItemPos, mainOrientation);
}

function closeSubmenuInFrame()
{
  var selectedItem = _itemRef;
  var submenuToClose = _mi[selectedItem][3];
  var targetFrame = _mi[selectedItem][35];
  parent.frames[targetFrame].menuDisplay(parent.frames[targetFrame].submenuToClose, 0);
}

