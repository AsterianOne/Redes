<html>
<style type="text/css">
   body {
      margin-left: 0px;
      margin-top: 0px;
      margin-right: 0px;
      margin-bottom: 0px;
   }
</style>
<script type="text/javascript" src="../pesquisar/jquery.js"></script>
<script type="text/javascript" src="../pesquisar/jquery.watermarkinput.js"></script>
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
url: "../pesquisar/search.php",
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
      <body>
      <div style="float:right; margin-left:10px; margin-top:0px;">
      <table class="tab_pesquisa";>
         <tr>
            <td height="29" right="80">
         <input type="text" class="search" id="searchbox"/>
               </td>
            <td width="4%" align="center" valign="center">
      <img src="../img/pesq.png"/></td>
         </tr>
         </table>
      <div id="display">
      </div>
      </div>
      </body>
</html>