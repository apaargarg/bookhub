<?php
$bookname=$_POST['bookname'];

if($bookname=="" ){
	die ("Bookname is not valid");
}
else{
	mysql_connect('localhost','root','') or die ("could not connect to database");
	mysql_select_db('BookHub') or die ("no database");
	#echo $username . " " . $password;
	$sql = mysql_query("SELECT * FROM books WHERE bookname Like '$bookname'");
	$Count = mysql_num_rows($sql);
	if ($Count == 0) {
		die ("No such book present in the database");
	}
	else {

		while($row=mysql_fetch_array($sql)){
		echo "<div class ='subresult'>bookname:" . $row['bookname'] . "<br>author:" . $row['author'] . "<br>Genre:" . $row['genre'] .  "<br>plot:" . $row['plot'] . "<br>rating:" . $row['rating'] . "</div>"; 
		echo "<br>";
		}
	}
}
?>