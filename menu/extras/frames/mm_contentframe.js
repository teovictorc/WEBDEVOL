/*
   Milonic DHTML Menu Frames Based Content Module  mm_contentframe.js version 1.0 - March 22 2005
   Written by Kevin Clements
   This module is only compatible with the Milonic DHTML Menu version 5.62 or higher

   Copyright 2005 (c) Milonic Solutions Limited. All Rights Reserved.
   This is a commercial software product, please visit http://www.milonic.com/ for more information.
   
   This code should be loaded into the content frame, where submenus will be displayed along with main content 
*/

function openSubmenu(menuName, selectedItemPos, mainOrientation)
{
  menuNum = getMenuByName(menuName);
  menuObj = gmobj("menu" + getMenuByName(menuName));

  if (mainOrientation == 0) { // vertical main
    subTop = selectedItemPos[0] + subAdjustTop_V
    subLeft = subAdjustLeft_V;
  }
  else {
    subTop = subAdjustTop_H;
    subLeft = selectedItemPos[1] + subAdjustLeft_H;
  }
//  if (ie) subTop += _sT;
  subTop += _sT;

  spos(menuObj, subTop, subLeft);
  popup(menuName);
}

