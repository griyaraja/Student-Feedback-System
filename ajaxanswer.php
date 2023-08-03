<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include("database.php");
$sqlupd  = "UPDATE quiz_result SET selectedanswer='$_GET[answer]' WHERE quiz_resultid='$_GET[quiz_resultid]'";
$qsqlupd = mysqli_query($con,$sqlupd);
echo mysqli_error($con);
?>
<?php
$sqlqz ="SELECT * FROM quiz_result WHERE quiztopicid='$_SESSION[quiztopicid]' AND date='$_SESSION[dttim]' AND studentid='$_SESSION[studentid]' and selectedanswer != ''";
$qsqlqz  = mysqli_query($con,$sqlqz);
?>
<input type="hidden" name="answereedq" id="answereedq" value="<?php echo mysqli_num_rows($qsqlqz); ?>" >
<?php
$sqlqz ="SELECT * FROM quiz_result WHERE quiztopicid='$_SESSION[quiztopicid]' AND date='$_SESSION[dttim]' AND studentid='$_SESSION[studentid]' and selectedanswer=''";
$qsqlqz  = mysqli_query($con,$sqlqz);
?>
<input type="hidden" name="unanswereedq" id="unanswereedq" value="<?php echo mysqli_num_rows($qsqlqz); ?>" >