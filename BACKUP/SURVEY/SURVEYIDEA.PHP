<?php

$mysqli = new mysqli("LOCALHOST", "ADMIN", "PASSWORD1");

$filter=mysql_query("select * from CORRAL_PROJECT"); = MySQL query to select the data from the database name.
while($row = mysql_fetch_array($filter)) = this part is where you fetch the value to be displayed on your dropdown option.

The first two lines can be anywhere inside your PHP code, preferably near the top. They are the ones connecting to your database to pull information which you will be using in your Drop Down field.

The third line would go similarly to how it is posted in his script:

// Add options to the drop down
$menu=" ";
while($row = mysql_fetch_array($filter))

{
  $menu .="<ANSWER_ID>" . $row['ANSWER'] . "</option>";
}
// Close menu form
$menu = "</select></form>";

// Output dropdown menu
echo $menu;

          <select class="form-dropdown" style="width:150px" id="input_5" name="q5_listOf">
            <option value="">  </option>
            <option value="Alan"> Alan </option>
            <option value="Ben"> Ben </option>
            <option value="Chris"> Chris </option>
            <option value="Donald"> Donald </option>
            <option value="Edgar"> Edgar </option>
            <option value="Fritz"> Fritz </option>
            <option value="Gomez"> Gomez </option>
            <option value="Huan"> Huan </option>
            <option value="Ian"> Ian </option>
            <option value="Jon"> Jon </option>
            <option value="Kally"> Kally </option>
            <option value="Liam"> Liam </option>
          </select>

You would modify it with the code above, like this:

          <select class="form-dropdown" style="width:150px" id="input_5" name="q5_listOf">
<?php
$mysqli = new mysqli("LOCALHOST", "ADMIN", "PASSWORD1");
$filter=mysql_query("select dropdown_option from dropdown_db");
$menu=" ";

// Add options to the drop down
while($row = mysql_fetch_array($filter))



{
  $menu .="<ANSWER>" . $row['ANSWER'] . "</option>";
}



// Close menu form
$menu = "</select></form>";



// Output dropdown menu
echo $menu;

?>
          </select>


?>
