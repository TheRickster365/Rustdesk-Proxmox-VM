<?php

/*
Rustdesk database schema

CREATE TABLE peer (
                guid blob primary key not null,
                id varchar(100) not null,
                uuid blob not null,
                pk blob not null,
                created_at datetime not null default(current_timestamp),
                user blob,
                status tinyint,
                note varchar(300),
                info text not null
            ) without rowid;
*/


echo<<<EOF
<html>
<head>
<!-- Refresh page every day -->
<meta http-equiv="refresh" content="86400" />
<title>Rustdesk Clients</title>
<style>
    thead, .th {border: 1px solid black;font-weight: bold;}
    .error  {background: purple; color: white;}
    .warn {background: orange;}
    .expired  {background: red; color: white;}
    .ok {background: lightgreen;}
    body {background-color: #ffffff; color: #000000;}
    body, td, th, h1, h2 {font-family: sans-serif;}
    pre {margin: 0px; font-family: monospace;}
    a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
    a:hover {text-decoration: underline;}
    table {border-collapse: collapse;}
    .center {text-align: center;}
    .center table { margin-left: auto; margin-right: auto; text-align: left;}
    .center th { text-align: center !important; }
    td, th { border: 1px solid #000000; font-size: 90%; vertical-align: baseline;}
    h1 {font-size: 150%;}
    h2 {font-size: 75%;}
    .p {text-align: left;}
    .e {background-color: #ccccff; font-weight: bold; color: #000000;}
    .h {background-color: #9999cc; font-weight: bold; color: #000000;}
    .v {background-color: #cccccc; color: #000000;}
    .vr {background-color: #cccccc; text-align: right; color: #000000;}
    img {float: right; border: 0px;}
    hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;} 
</style>
<script>
function update_note(id){

var note=prompt("Please enter note");
//window.alert(id + "  " + note);
note = note.replace("'", "''");

var URL = "rustdesk_update_note.php?id="+id+"&note="+note;

//window.open(URL, '_blank');


var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       //document.getElementById("demo").innerHTML = xhttp.responseText;
	window.location.reload();
    }
};
xhttp.open("GET", URL, true);
xhttp.send();



}
</script>
</head>
<body>
<h1>Rustdesk Clients</h1>
<table  cellspacing="1" cellpadding="3">
<thead>
<tr>
<td> # </td>
<td> ID </td>
<td> Created </td>
<td> IP Adress </td> 
<td> Status </td> 
<td> Note </td> 
<td> Update </td> 
</tr>
</thead>
EOF;


$i = 1;

$db = new SQLite3('/var/lib/rustdesk-server/db_v2.sqlite3');
$results = $db->query('SELECT * FROM peer');
while ($res = $results->fetchArray()) {
    //var_dump($res);

    $id = $res['id'];

    echo "<tr class=ok>\n";

    echo "<td>".$i."</td>";

    echo "<td>".$res['id']."</td>";
    echo "<td>".$res['created_at']."</td>";

    //{"ip":"::ffff:203.34.58.50"}
    $info = $res['info'];
    $pieces = explode(":", $info);
    $ip = substr ($pieces[4],0,strlen($pieces[4])-2);


    echo "<td>".$ip."</td>";
    echo "<td>".$res['status']."</td>";
    echo "<td>".$res['note']."</td>";

    echo "<td><input type='button' value='Notes' onclick=update_note($id); /></td>";

    echo "</tr>\n";

    $i++;
}

echo "</html>\n";
echo "</table>\n";

$db->close();

?>
