<?php
$filename = 'test.xls';
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);

header("Pragma: no-cache"); 
header("Expires: 0"); 
echo $content_for_layout;

?>