_menuCloseDelay=0 //100           // The time delay for menus to remain visible on mouse out
_menuOpenDelay=0 //100            // The time delay before menus open on mouse over
_subOffsetTop=0              // Sub menu top offset
_subOffsetLeft=-2            // Sub menu left offset

var subAdjustTop_H = 0;
var subAdjustLeft_H = -126;
var subAdjustTop_V = 0;
var subAdjustLeft_V = 0;

/// Style Definitions ///

with(subStyle=new mm_style()){
onbgcolor="#BCBDDB";
oncolor="#323197";
offbgcolor="#9495B3";
offcolor="#FFFFFF";
bordercolor="#323197";
borderstyle="solid";
borderwidth=1;
separatorcolor="#323197";
separatorsize=2;
padding=3;
fontsize=11;
fontstyle="normal";
fontfamily="Verdana, Tahoma, Arial";
subimage="submenu_arrow_right-off.gif";
onsubimage="submenu_arrow_right-on.gif";
high3dcolor="#E0E1FF";
low3dcolor="#70718F";
swap3d=1;
}

/// Submenu Definitions ///

// Search

with(milonic=new menuname("search")){
style=subStyle;
aI("text=Google;url=body.htm?tp=www.google.com;");
aI("text=Yahoo;url=body.htm?tp=www.yahoo.com;");
aI("text=Others;showmenu=otherSearch;");
}

with(milonic=new menuname("otherSearch")){
style=subStyle;
aI("text=Altavista;url=body.htm?tp=www.altavista.com;");
aI("text=Ask Jeeves;url=body.htm?tp=www.ask.com;");
aI("text=Excite;url=body.htm?tp=www.excite.com;");
aI("text=Go.com;url=body.htm?tp=infoseek.go.com;");
aI("text=Lycos;url=body.htm?tp=www.lycos.com;");
}

// News

with(milonic=new menuname("news")){
style=subStyle;
aI("text=Newspapers;showmenu=newspapers;");
aI("text=Networks;showmenu=networks;");
aI("text=Tech News;showmenu=technews;");
}

with(milonic=new menuname("newspapers")){
style=subStyle;
aI("text=Los Angeles Times;url=body.htm?tp=www.latimes.com;");
aI("text=New York Times;url=body.htm?tp=www.nytimes.com;");
aI("text=USA Today;url=body.htm?tp=www.usatoday.com;");
aI("text=Wall Street Journal;url=body.htm?tp=www.wsj.com;");
aI("text=Washington Post;url=body.htm?tp=www.washingtonpost.com;");
}

with(milonic=new menuname("networks")){
style=subStyle;
aI("text=ABC News;url=body.htm?tp=abcnews.go.com;");
aI("text=BBC News;url=body.htm?tp=news.bbc.co.uk/shared/hi/interstitial-news.stm;");
aI("text=CBS News;url=body.htm?tp=www.cbsnews.com;");
aI("text=CNN;url=body.htm?tp=www.cnn.com;");
aI("text=FOX News;url=body.htm?tp=www.foxnews.com;");
aI("text=MSNBC;url=body.htm?tp=www.msnbc.com;");
}

with(milonic=new menuname("technews")){
style=subStyle;
aI("text=CNET News;url=body.htm?tp=news.com.com;");
aI("text=Slash Dot;url=body.htm?tp=www.slashdot.com;");
aI("text=Tech Web;url=body.htm?tp=www.techweb.com;");
aI("text=Wired;url=body.htm?tp=www.wired.com;");
}

// References

with(milonic=new menuname("references")){
style=subStyle;
aI("text=HTML;showmenu=html;");
aI("text=CSS;showmenu=css;");
aI("text=Javascript;showmenu=javascript;");
}

with(milonic=new menuname("html")){
style=subStyle;
aI("text=DevGuru;url=body.htm?tp=www.devguru.com/Technologies/html/quickref/html_intro.html;");
aI("text=HotSource;url=body.htm?tp=www.sbrady.com/hotsource/html;");
aI("text=Website Tips;url=body.htm?tp=websitetips.com/html;");
aI("text=W3Schools;url=body.htm?tp=www.w3schools.com/html/default.asp;");
}

with(milonic=new menuname("css")){
style=subStyle;
aI("text=DevGuru;url=body.htm?tp=www.devguru.com/Technologies/css/quickref/css_intro.html;");
aI("text=HotSource;url=body.htm?tp=www.sbrady.com/hotsource/css;");
aI("text=Website Tips;url=body.htm?tp=www.websitetips.com/css/index.shtml;");
aI("text=W3Schools;url=body.htm?tp=www.w3schools.com/css;");
aI("text=Mako 4 CSS;url=body.htm?tp=www.mako4css.com;");
}

with(milonic=new menuname("javascript")){
style=subStyle;
aI("text=DevGuru;url=body.htm?tp=www.devguru.com/Technologies/ecmascript/quickref/javascript_intro.html;");
aI("text=HotSource;url=body.htm?tp=www.sbrady.com/hotsource/javascript;");
aI("text=W3Schools;url=body.htm?tp=www.w3schools.com/js/default.asp;");
aI("text=Doc Javascript;url=body.htm?tp=www.webreference.com/js;");
aI("text=MS JScript;url=body.htm?tp=msdn.microsoft.com/library/default.asp?url=/library/en-us/script56/html/js56jslrffeatureinformation.asp;");
}



drawMenus();

