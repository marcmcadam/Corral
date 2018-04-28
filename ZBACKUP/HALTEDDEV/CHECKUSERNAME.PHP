<?php
require_once('connect.php');

if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);

	$sql = "SELECT * FROM `login` WHERE username='$username'";
	$result = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($result);
	if($count == 1){
		echo "Username Not Available";
	}else{
		echo "Username Available";
	}
}


-moz-box-sizing
<span id="STUDENT_IDLoading"><img src="" alt="" /></span>
<span id="STUDENT_IDResult"></span>

<script type="text/javascript">
  $(document).ready(function() {
    $('#STUDENT_IDLoading').hide();
    $('#STUDENT_ID').keyup(function(){
      $('#STUDENT_IDLoading').show();
        $.post("check.php", {
          STUDENT_ID: $('#STUDENT_ID').val()
        }, function(response){
          $('#STUDENT_IDResult').fadeOut();
          setTimeout("finishAjax('STUDENT_IDResult', '"+escape(response)+"')", 400);
        });
        return false;
    });
  });

  function finishAjax(id, response) {
    $('#STUDENT_IDLoading').hide();
    $('#'+id).html(unescape(response));
    $('#'+id).fadeIn();
  } //finishAjax
</script>
