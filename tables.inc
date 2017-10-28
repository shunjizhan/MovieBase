<?php
class Table {
   var $data;

   function __construct($data) {
       $this->data = $data;
       $this->create();
   }

   function create() {
     $result = $this->data;
     print "<table>";

     print "<tr>";
     for($i = 0; $i < mysql_num_fields($result); $i++) {
         $field_info = mysql_fetch_field($result, $i);
         echo "<th>{$field_info->name}</th>";
     }
     print "</tr>";

     while($row = mysql_fetch_row($result)) {
       print "<tr>";
       $id = $row[0];
       for($i = 0; $i < count($row); $i++) {
         print "<th><a href='Show_A.php?id={$id}'>$row[$i]</a></th>";
       }
       print "</tr>";
     }
     print "</table>";
   }

}
?>
