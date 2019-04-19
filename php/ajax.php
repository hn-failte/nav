<?php
if($_GET==[] || strlen($_GET["_"])!=13) {
  echo "404 Not Found";
  die();
}
mysql_connect("127.0.0.1","failte","52171250");
mysql_query("use nav");
$sql="select * from links";
$result=mysql_query($sql);
$rows=[];
while ($row=mysql_fetch_assoc($result)) {
    $rows[]=$row;
}
echo json_encode($rows);
?>