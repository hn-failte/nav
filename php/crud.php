<?php
mysql_connect("127.0.0.1","failte","52171250");
mysql_query("use nav");
if($_GET==[]) die();
$action = $_GET["a"];
switch($action){
    case "c":
        $link_name=$_GET["link_name"];
        $link_value=$_GET["link_value"];
        $sql="insert into links(link_name, link_value) values('$link_name','$link_value')";
        mysql_query($sql);
        $affect=mysql_affected_rows();
        if($affect>0) echo "1";
        else echo "0";
        break;
    case "r":
        $link_id=$_GET["link_id"];
        $sql="select * from links where link_id=".$link_id;
        $result=mysql_query($sql);
        $row=mysql_fetch_assoc($result);
        echo json_encode($row);
        break;
    case "u":
        $link_id=$_GET["link_id"];
        $link_name=$_GET["link_name"];
        $link_value=$_GET["link_value"];
        $sql="update links set link_name='$link_name',link_value='$link_value' where link_id='$link_id'";
        mysql_query($sql);
        $affect=mysql_affected_rows();
        if($affect>0) echo "1";
        else echo "0";
        break;
    case "d":
        $link_id=$_GET["link_id"];
        $sql="delete from links where link_id=".$link_id;
        mysql_query($sql);
        $affect=mysql_affected_rows();
        if($affect>0) echo "1";
        else echo "0";
        break;
    default:
        die();
}
?>