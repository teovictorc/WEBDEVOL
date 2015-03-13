_menuCloseDelay=0 //100           // The time delay for menus to remain visible on mouse out
_menuOpenDelay=0 //100            // The time delay before menus open on mouse over
_subOffsetTop=0              // Sub menu top offset
_subOffsetLeft=-2            // Sub menu left offset

/// Style Definitions ///

with(mainStyleVert=new mm_style()){
onbgcolor="#fefeee";
oncolor="#4F8EB6";
offbgcolor="#4F8EB6";
offcolor="#FFFFFF";
bordercolor="#323197";
borderstyle="solid";
borderwidth=1;
separatorcolor="#323197";
separatorsize=2;
padding=4;
fontsize=12;
fontstyle="normal";
fontfamily="Verdana, Tahoma, Arial";
subimage="submenu_arrow_right-off.gif";
onsubimage="submenu_arrow_right-on.gif";
high3dcolor="#E0E1FF";
low3dcolor="#70718F";
swap3d=1;
headerbgcolor="#3f7498";
headercolor="#f2f2ff";
}

// Main

with(milonic=new menuname("mainMenuVert")){
style=mainStyleVert;
top=50;
left=0;
itemwidth=123;
alwaysvisible=1;
aI("text=References;showmenu=references;target=body;onfunction=openSubmenuInFrame();offfunction=closeSubmenuInFrame();");
aI("text=News&nbsp;Sites;showmenu=news;target=body;onfunction=openSubmenuInFrame();offfunction=closeSubmenuInFrame();");
aI("text=Search Sites;showmenu=search;target=body;onfunction=openSubmenuInFrame();offfunction=closeSubmenuInFrame();");
}

drawMenus();
