<?php
  include 'KurdishConverter.php';

  $KC = new KurdishConverter("543");
  $output = $KC->generateText();
  echo $output;
?>
