<?php
    $PageTitle = "Sorting Setup";
    require "header_staff.php";

    require "getdata.php";
?>
<div style="text-align: center; width: 100%;">
    <form action="begin2.php" method="post">
        <table align='center'>
            <tr>
                <td style="min-width: 128px;">&nbsp;</td>
                <td style="min-width: 256px;"><input type="submit" value="Start Sorting" class="inputButton"></td>
                <td style="max-width: 768px;">
                    Once a large number of batches are processed without any swaps happening, the process is complete.<br>
                    Only increasing the quality will gain further improvement.<br>
                    <br>
                    <br>
                </td>
            </tr><tr>
                <td style="min-width: 128px;">&nbsp;</td>
                <td style="min-width: 256px;">&nbsp;</td>
                <td style="max-width: 768px;">&nbsp;</td>
            </tr><tr>
                <td style="min-width: 128px;">Running Time</td>
                <td style="min-width: 256px;"><input class="inputBox" type="text" name="iterations" value="<?php echo $sortIterations; ?>"></td>
                <td style="max-width: 768px;">
                    This is how many times the sorting will be repeated to try to improve the result.<br>
                    Use the minimum that you think would finish sorting.<br>
                    If it does not complete, the sorting can be continued by running this again.<br>
                    <br>
                    <br>
                </td>
            </tr><tr>
                <td style="min-width: 128px;">Quality</td>
                <td style="min-width: 256px;"><input class="inputBox" type="text" name="matrix" value="<?php echo $sortMatrix; ?>"></td>
                <td style="max-width: 768px;">
                    This is how many students are compared at once. Increasing this:<br>
                    - Allows more complex swaps, and will have a better result.<br>
                    - Risks the server calculations timing-out or using too much memory.<br>
                    Use the maximum available for server limits.<br>
                    <br>
                </td>
            </tr><?php /* <tr>
                <td style="min-width: 128px;">Randomisation</td>
                <td style="min-width: 256px;"><input class="inputBox" type="text" name="random" value="<?php echo $sortRandom; ?>"></td>
                <td style="max-width: 768px;">Randomises the value function of making changes by up to this amount. Very low randomisation may cause the process to slow or abort. It is recommended to use a number than is small enough to be negligible compared to your project skill costs.<br><br></td>
            </tr><tr>
                <td style="min-width: 128px;">Max Inertia</td>
                <td style="min-width: 256px;"><input class="inputBox" type="text" name="inertia" value="<?php echo $sortInertia; ?>"></td>
                <td style="max-width: 768px;">Inertia is a resistance to change. This number is a reward for leaving the group-assignments as they are. Inertia starts at 0 and increases to Max-Inertia by the last iteration. It is recommended to set this to be at least as large as Randomisation, to avoid continuous changes with no purpose.<br><br></td>
            </tr> */ ?>
        </table>
    </form>
</div>
<?php
    require "footer.php";
?>
