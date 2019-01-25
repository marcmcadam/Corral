<?php
    $adminPassword = "Password123";

    require_once "../connectdb.php";
    require "../encryptor.php";

    $hashPassword = encrypt_decrypt('encrypt', $adminPassword);
    $insert = "INSERT INTO staff (sta_ID, sta_FirstName, sta_LastName, sta_Campus, sta_Email, sta_Password) VALUES 
                                    (999999, 'Staff', 'Administrator', 3, 'admin@deakin.edu.au', '$hashPassword')";
    if (mysqli_query($CON, $insert))
        echo "<P>Admin account created.</P>";
    else
        echo "<p>Error creating admin account: " . mysqli_error($CON) . "</p>";
?>
