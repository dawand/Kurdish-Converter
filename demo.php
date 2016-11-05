<html>
<body>
<form method="post">
  <input type="text" name="englishNumber">
  <input type="submit" name="Submit" value="convert!">
</form>

<?php
  include 'KurdishConverter.php';

  if (isset($_REQUEST['Submit']))
  {
    $KC = new KurdishConverter($_REQUEST['englishNumber']);
    $output = $KC->generateText();
    echo $output;
  }
?>
</body>
</html>
