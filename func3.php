<?php
session_start();

// ✅ Updated Database Connection (Online MySQL)
$host = 'sql12.freesqldatabase.com';
$dbname = 'sql12621459';
$username = 'sql12621459';
$password = 'wD3!qR5*';

$con = mysqli_connect($host, $username, $password, $dbname);

// ❌ If connection fails, stop here
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ✅ Admin Login
if (isset($_POST['adsub'])) {
    $username = $_POST['username1'];
    $password = $_POST['password2'];
    $query = "SELECT * FROM admintb WHERE username='$username' AND password='$password';";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location:admin-panel1.php");
    } else {
        echo ("<script>alert('Invalid Username or Password. Try Again!');
        window.location.href = 'index.php';</script>");
    }
}

// ✅ Update Appointment
if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];
    $query = "UPDATE appointmenttb SET payment='$status' WHERE contact='$contact';";
    $result = mysqli_query($con, $query);
    if ($result)
        header("Location:updated.php");
}

// ✅ Display Doctors
function display_docs()
{
    global $con;
    $query = "SELECT * FROM doctb";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        echo '<option value="' . $name . '">' . $name . '</option>';
    }
}

// ✅ Add Doctor
if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];
    $query = "INSERT INTO doctb(name) VALUES('$name')";
    $result = mysqli_query($con, $query);
    if ($result)
        header("Location:adddoc.php");
}
?>
