<!DOCTYPE html>
<html>
<head>
	<title>General read form</title>
	<meta charset="utf-8">
</head>

<body>

The following Name-Value pairs have been received via the POST method.  <br/>
The <b>$_post</b> variable contains an array of all the Name-Value pairs sent from the client. <br/>
It is read using a <b>foreach()</b> loop.

<table> <tr> <td> NAME </td> <td> </td> <td> VALUE </td> </tr>

<?php
foreach ($_POST as $varname => $varvalue) {
    echo ("
		<tr> <td>$varname </td> 
		<td>&nbsp; = &nbsp;</td> 
		<td> $varvalue </td> 
		</tr> "); 
}
?>

</table> 
<p> The following are obtained from the $_GET array - that is all the variables sent via the GET Method</p>  
<table> <tr> <td> NAME </td> <td> </td> <td> VALUE </td> </tr>

<?php
foreach ($_GET as $varname => $varvalue) {
    echo ("
		<tr> <td>$varname </td> 
		<td>&nbsp; = &nbsp;</td> 
		<td> $varvalue </td> 
		</tr> <br>"); 
}
?>

</table> 
<p> The following are obtained from the $_ REQUEST  array - which contains is all the variables sent by both the GET and POST Methods and related cookies</p>  

<?php
foreach ($_REQUEST as $varname => $varvalue) {
    echo ("$varname = $varvalue <br>"); }
?>

<br/><br/>

</body>
</html>
