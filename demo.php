<?php
    include 'KurdishConverter.php';

    $KC = new KurdishConverter($_REQUEST['englishNumber']);
    $output = $KC->generateText();
    echo $output;
?>
