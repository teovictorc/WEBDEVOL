<?php



$menuData="";

class mmenuStyle
{
	
	function createMenuStyle($styleName)
	{
		global $menuData;
		$styleArray=get_object_vars($this);
		$menuData.="with($styleName=new mm_style()){\n";
		
		foreach ($styleArray as $fieldName => $fieldValue) 
		{
			if(ereg("color",$fieldName))
			{
				if(substr($fieldValue,0,1)!="#" && is_numeric($fieldValue))$fieldValue="#".$fieldValue;
			}
			
			$menuData.= "$fieldName=\"$fieldValue\";\n";
		}
   
		$menuData.= "}\n\n";
	}
}






class mMenu
{
	var $menuItems;
	function createMenu($menuName)
	{
		global $menuData;
		$menuArray=get_object_vars($this);

		$menuData.= "with(milonic=new menuname(\"$menuName\")){\n";
		$tempMenuItems="";
		foreach ($menuArray as $fieldName => $fieldValue) 
		{
			global $menuData;
			if($fieldName!="menuItems")
			{
				if($fieldName=="style")
				{
					$menuData.= "$fieldName=$fieldValue;\n";
				}
				else
				{
					$menuData.= "$fieldName=\"$fieldValue\";\n";
				}
				
			}
			else
			{
				if($fieldName=="menuItems")$tempMenuItems=$fieldValue;
			}
		}
   
   		$menuData.= $tempMenuItems."\n";
		$menuData.= "}\n\n";
	}
	
	
	function addItemFromText($itemText)
	{
		global $menuData;
		$this->menuItems.="aI(\"".$itemText . "\");\n";	
	}
	

	function addItemFromItem($menuItem)
	{
		global $menuData;
		$tempVar="";
		foreach ($menuItem as $fieldName => $fieldValue) 
		{
			if(ereg("color",$fieldName))
			{
				if(substr($fieldValue,0,1)!="#")$fieldValue="#".$fieldValue;
			}			
			
			$tempVar.="$fieldName=$fieldValue;";
		}
		$this->menuItems.="aI(\"".$tempVar . "\");\n";	
	}	
	
}


class mItem
{
	function addItemElement($mtype,$mval)
	{
		$this->$mtype=$mval;
	}
}


function commitMenus()
{
	global $menuData,$menuVars;
	
	
echo "



<SCRIPT language=\"JavaScript\" src=\"$menuVars[pathToCodeFiles]$menuVars[file_milonicsrc]\" type=\"text/javascript\"></SCRIPT>	
<script	language=\"JavaScript\">

if(ns4)_d.write(\"<scr\"+\"ipt language=JavaScript src=$menuVars[pathToCodeFiles]$menuVars[file_mmenuns4]><\/scr\"+\"ipt>\");		
  else _d.write(\"<scr\"+\"ipt language=JavaScript src=$menuVars[pathToCodeFiles]$menuVars[file_mmenudom]><\/scr\"+\"ipt>\"); 
</script>
";

flush();
	

echo "<script>\n
_menuCloseDelay=$menuVars[menuCloseDelay];
_menuOpenDelay=$menuVars[menuOpenDelay];
_subOffsetTop=$menuVars[subOffsetTop];
_subOffsetLeft=$menuVars[subOffsetLeft]


$menuData";
echo "drawMenus();\n";
echo "</script>\n";	
}





?>