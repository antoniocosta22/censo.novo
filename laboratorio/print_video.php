<!DOCTYPE html>
<html>
<body>

<h3>A demonstration of how to access a VIDEO element</h3>

<video id="myVideo" width="320" height="240" controls>
  <source src="movie.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>

<p>Click the button to get the duration of the video, in seconds.</p>

<button onclick="myFunction()">Try it</button>

<p id="demo"></p>

<script>
function myFunction() {
  var x = document.getElementById("myVideo").duration;
  document.getElementById("demo").innerHTML = x;
}
</script>

</body>
</html>