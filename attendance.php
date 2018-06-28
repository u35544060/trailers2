<html>
<body>

<?
$StuNumVar= $_GET['WYStuNum'];

$db = mysql_connect("db516865968.db.1and1.com", "dbo516865968", "^&67Jh##") or die(mysql_error());

mysql_select_db("db516865968", $db) or die(mysql_error());

$query="Select FirstName, LastName, WYStuNum from Students where active = 1 order by LastName, FirstName";
$query2="Select * from Students where WYStuNum=" . $StuNumVar . "";
$result= mysql_query($query);
$result2= mysql_query($query2);
$num=mysql_num_rows($result);
?>

<font face="Arial">
<table>
	<tr style="vertical-align:top">
	<td>
		<table>
			<tr>
			<td colspan=3><img src="/Images/KimLogo.jpg"></td>
			</tr>
			<tr>
			<td colspan=3 bgcolor="#ff9933"><font color=white><strong><center>Students</center></strong></font></td>
			</tr>
			<tr>
			<td bgcolor="#0099ff"><font color=white><small>Active</small></font></td><td bgcolor="#0033ff"><font color=white><small>Inactive</small></font></td><td bgcolor="#0033ff"><font color=white><small>All</small></font></td>
			</tr>
			<tr>
			<td colspan=3><?php while ($row = mysql_fetch_array($result))
							{
								echo "<a href=\"/index.php?WYStuNum=";
								echo $row['WYStuNum'] ."\">";
								echo $row['FirstName'] . " " . $row['LastName'];
								echo "</a>";
								echo "<br>";
							}
							mysql_close($db);
							?>
							</td>
			</tr>
			<tr>
			<td colspan=3 bgcolor="#cccccc"><font color=white>Add a Student</font></td>
			</tr>
			<tr>
			<td colspan=3 bgcolor="#000000"><font color=white>Student Total:<?php echo $num; ?></font></td>
			</tr>
			<tr>
			<td>&nbsp;</td><td>&nbsp;</td><td>Admin</td>
			</tr>
		</table>
</td>
	<td>
		<table>
			<tr>
			<td colspan=2 bgcolor="#000000"><font color=white><strong><h2><center><a style="text-decoration:none; color:#ffffff" href="/index.php">Students</a></center></h2></strong></font></td>
			<td colspan=2 bgcolor="#000000"><font color=white><strong><h2><center><a style="text-decoration:none; color:#ffffff" href="/Dash2.php">Dashboard</a></center></h2></strong></font></td>
			<td colspan=2 bgcolor="#cccccc"><strong><h2><center>Attendance</center></h2></strong></font></td>
			</tr>
<tr><td Colspan=6>

<?
$db = mysql_connect("db516865968.db.1and1.com", "dbo516865968", "^&67Jh##") or die(mysql_error());

mysql_select_db("db516865968", $db) or die(mysql_error());

$querystu="Select FirstName, LastName, WYStuNum from Students where active=1 order by LastName, FirstName";
$resultstu= mysql_query($querystu);

?>


<form action="attendance.php" method="post">
<table><tr>
<?php 
	$x=0;
	while ($row = mysql_fetch_array($resultstu))
			{
				$x++; ?>
				<td> <img src="/StuImag/Student<?php echo $row['WYStuNum']; ?>.jpg"><br> <?php echo $row['FirstName'] . " " . $row['LastName'] . "<input type=\"checkbox\" name=\"check_list[]\" value=\"" . $row['WYStuNum'] . "\"</td>";
				
                                if ($x == 3) {
				$x=0;
 				echo "</tr><tr>";
				}
				
			}
			
?>

</tr></table>

<input type="submit" /><input type="reset" />
</form>

<?php
$x=0;
if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
           
$sql="insert into Attendance (WYStuNum,DateAtt) values ($check,CURDATE() )";
$result = mysql_query($sql);
$x=$x+1;
   }
}
echo "$x people have been marked as present";
?>
</td>
</tr>
</table>