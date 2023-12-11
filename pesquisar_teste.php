<?php
include("../sessao/sessao.php");
ob_start();
?>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<script type="text/javascript" src="./pesquisar/jquery.js"></script>
<script type="text/javascript" src="./pesquisar/jquery.watermarkinput.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$(".search").keyup(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;

if(searchbox=='')
{
}
else
{

$.ajax({
type: "POST",
url: "./pesquisar/search.php",
data: dataString,
cache: false,
success: function(html)
{

$("#display").html(html).show();
	
	
	}




});
}return false;    


});
});

jQuery(function($){
   $("#searchbox").Watermark("Pesquisar...");
   });
</script>
<style type="text/css">
body
{
margin:0px;
margin-top:0px;
}
#searchbox
{
width:600px;
padding:3px;
text-align:center;

}
#display
{
width:95%;
display:none;
float:left; margin-left:0px;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
}
.display_box
{
padding:1px; border-top:solid 1px #dedede; font-size:14px; height:30px; padding:3px; color: #000;
}

.display_box:hover
{
background:#4582C3;
color:#FFFFFF;
}
#shade
{
background-color:#00CCFF;
}

</style>
</head>

<body>
  <div style="float:center; margin-left:10px; margin-top:0px;">
  <table width="580px";>
  	<tr>
    	<td height="29" right="80">
   <input type="text" class="search" id="searchbox"  style="margin-top:0px; width: 565px ;height:25px"/>
   		</td>
        <td width="4%" align="center" valign="center">
  <img src="./img/pesq.png"/></td>
   </tr>
   </table>
<div id="display" style="position: absolute; width: 600px; margin-left: 30px; background-color: #fff">
</div>

</div>

</body>
</html>