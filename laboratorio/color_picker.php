<!DOCTYPE html>
<html>
<body>

<h3>A demonstration of how to access a Color picker</h3>

Select your favorite color: <input type="color" id="myColor">

<p>Click the "Try it" button to get the color of the color picker.</p>

<button onclick="myFunction()">Try it</button>

<p><b>Note:</b> type="color" is not supported in Internet Explorer 11 and earlier versions or Safari 9.1 and earlier versions.</p>

<p id="demo"></p>

<script>
function myFunction() {
  var x = document.getElementById("myColor").value;
  document.getElementById("demo").innerHTML = x;
}
</script>

</body>
</html>