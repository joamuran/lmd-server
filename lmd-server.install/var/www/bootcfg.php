<?php

header ( "Content-type: text/plain" );

echo "UI iPXE Boot\n\n";
echo "LABEL iPXE Boot\n";
echo "COM32 vesamenu.c32\n";
echo "APPEND menu.php\n";
?>