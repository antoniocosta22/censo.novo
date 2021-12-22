<!DOCTYPE html>
<html>
<head>
<script language=javascript type="text/javascript">
function myFunction() {
  popup = window.open("https://www.w3schools.com", "", "toolbar=yes,scrollbars=yes,resizable=yes,top=170,left=-1000,width=400,height=400");
}
function fecharPopup(){
fecharWindow = popup.close()
}
</script>
</head>
<body>
<a href="javascript:myFunction()">Abrir popup</a>
<br/>
<a href="javascript:fecharPopup()">Fechar Popup</a>
</body>
</html>