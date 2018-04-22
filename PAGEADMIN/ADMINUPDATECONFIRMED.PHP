<?PHP
require('../DATABASE/CONNECTDB.PHP');
// If the values are posted, (created by marc) insert them into the database.
{

  $PROJECTNAME = mysqli_real_escape_string($CON, $_POST['PROJECT_NAME']);
	$PROJECTBRIEF = mysqli_real_escape_string($CON, $_POST['PROJECT_BRIEF']);
	$PROJECTLEADER = mysqli_real_escape_string($CON, $_POST['PROJECT_LEADER']);
	$PROJECTSTATUS = mysqli_real_escape_string($CON, $_POST['PROJECT_STATUS']);
  $id=$_GET['id'];

  $CHANGEDATA = "UPDATE PROJECT SET PROJECT_NAME ='$PROJECTNAME',
                        PROJECT_BRIEF = '$PROJECTBRIEF',
                        PROJECT_LEADER = '$PROJECTLEADER',
                        PROJECT_STATUS = '$PROJECTSTATUS'
                        WHERE PROJECT_NUM = '$ID'";


                 if (mysqli_query($CON, $CHANGEDATA))
               	{
               		$result = "Project changed successfully.";
               	}
               	else
               	{
               		$result = "Error changing Project: " . mysqli_error($CON);
               	}

        }


    ?>





<html>
<head>

	<title>UPDATE PROJECT</title>
	<meta charset="UTF-8" />


</head>

   <body>

     <h1> Add Project </h1>
     <table>
         <tr>
           <td>Project Name: </td>
           <td> <?php echo $PROJECTNAME?> </td>
         </tr>
         <tr>
           <td>Project Brief: </td>
           <td> <?php echo $PROJECTBRIEF?> </td>
         </tr>
         <tr>
           <td>Project Leader: </td>
           <td> <?php echo $PROJECTLEADER?> </td>
         </tr>
         <tr>
           <td>Status: </td>
           <td> <?php echo $PROJECTSTATUS?> </td>
         </tr>
       </table>


   </body>

</html>
