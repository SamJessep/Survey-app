<?php
include '../admin/mysqliDB.php';
$p = $_POST;
$postData = array('name' => $p['firstName'].' '.$p['lastName'], 'email' => $p['email'], 'question1'=> $p['question1'], 'contacted'=>$p['contacted'] == 'on' ? 'yes' : 'no');
$tableData = array('name', 'email', 'question1', 'contacted');

run(addTable('testSurvey', $tableData));
$POST_SUCCESS = run(addResult('testSurvey', $postData));

$successTitle = "Thankyou your feedback has been submitted";
$failureTitle = "Error submitting data";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $POST_SUCCESS ? "Success" : "Error"?></title>
  </head>
  <body style="background-color:<?php echo $POST_SUCCESS ? 'green' : 'red';?>">
    <h1><?php echo $POST_SUCCESS ? $successTitle : $failureTitle;?></h1>
    <button onclick="()=>{window.close()}">Close page</button>
  </body>
</html>
