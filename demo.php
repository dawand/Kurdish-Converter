<?php
  include 'KurdishConverter.php';

//  if (isset($_REQUEST['Submit']))
//  {
    $KC = new KurdishConverter($_REQUEST['englishNumber']);
    $output = $KC->generateText();
    echo $output;
//  }
?>
