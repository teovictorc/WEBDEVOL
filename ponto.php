<html xmlns="http://www.w3.org/1999/xhtml"> 
<head id="Head1" runat="server"> 
    <title>Untitled Page</title> 
     
</head> 
<body onLoad="create();"> 
<script type="text/javascript"> 
        function create() 
        { 
           var net = new ActiveXObject("wscript.network"); 
           //alert(net.UserDomain+': '+net.ComputerName); 
           document.write(net.ComputerName); 
        } 
    </script> 

</body> 
</html>  
