<!doctype html>
<html lang="en">
<head>
  <title>Neo: Enter the Building Matrix</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="trinity.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/morpheus.css"/>
  <link rel="icon" href="assets/neo_logo.svg">
  <link rel="mask-icon" href="assets/neo_logo.svg" color="#00000000">
  <link rel="manifest" href="assets/manifest.json">
</head>
<body>
<div class="container">
  <nav>
    <img src="assets/snip_logo.svg" width="150px">
    <img src="assets/neo_logo.svg" width="150px">
  </nav>
  <div class="search">
    <input type="text" id="search"><br>
    <span class="buttons">
      <input type="button" onclick="pull()" value="Search">
      <input type="button" id="create" value="Create">
    </span>
  </div>
  <div id="show">
    <?php require('agent.php');?>
  </div>
</div>
</body>
</html>
