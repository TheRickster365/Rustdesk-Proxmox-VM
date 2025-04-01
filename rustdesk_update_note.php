<?php

/*
Need to set permissions to write to DB

chown root:www-data /var/lib/rustdesk-server/db_v2*
chmod 664 /var/lib/rustdesk-server/db_v2*

*/

if (isset($_GET['id']) &&
    isset($_GET['note'])) {

    $id = $_GET['id'];
    $note = $_GET['note'];


    $SQL="UPDATE peer set note='$note' WHERE id=$id";
    echo $SQL."<br/>";

    $db = new SQLite3('/var/lib/rustdesk-server/db_v2.sqlite3');
    
    //$SQL1 = $db->escapeString ($SQL);
    //echo $SQL1."<br/>";
    //$SQL1 = addslashes ($SQL);
    //echo $SQL1."<br/>";

    $results = $db->query($SQL);
    print_r($results);

    $db->close();

}
?>
