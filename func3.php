<?php
session_start();

// ✅ Use online database credentials
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12621459", "wD3!qR5*", "sql12621459");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Admin Login
if(isset($_POST['adsub'])){
	$username=$_POST['username1'];
	$password=$_POST['password2'];
	$query="select * from admintb where username='$username' and password='$password';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1) {
		$_SESSION['username']=$username;
		header("Location:admin-panel1.php");
	} else {
		echo("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index.php';</script>");
	}
}

// ✅ Update Appointment
if(isset($_POST['update_data']))
{
	$contact=$_POST['contact'];
	$status=$_POST['status'];
	$query="update appointmenttb set payment='$status' where contact='$contact';";
	$result=mysqli_query($con,$query);
	if($result)
		header("Location:updated.php");
}

// ✅ Display Doctors
function display_docs()
{
	global $con;
	$query="select * from doctb";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		$name=$row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
	}
}

// ✅ Add Doctor
if(isset($_POST['doc_sub']))
{
	$name=$_POST['name'];
	$query="insert into doctb(name)values('$name')";
	$result=mysqli_query($con,$query);
	if($result)
		header("Location:adddoc.php");
}
?>
