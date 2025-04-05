<?php
session_start();

// Connect to NeonDB (PostgreSQL)
$conn_string = "host=ep-snowy-tree-a1pctx1d-pooler.ap-southeast-1.aws.neon.tech port=5432 dbname=hospital_DB user=neondb_owner password=npg_Blop2Ye3VZij sslmode=require";
$con = pg_connect($conn_string);

if (!$con) {
    die("Connection failed: " . pg_last_error());
}

// Admin Login
if (isset($_POST['adsub'])) {
    $username = $_POST['username1'];
    $password = $_POST['password2'];

    $query = "SELECT * FROM admintb WHERE username = '$username' AND password = '$password'";
    $result = pg_query($con, $query);

    if (pg_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location:admin-panel1.php");
    } else {
        echo "<script>alert('Invalid Username or Password. Try Again!');
        window.location.href = 'index.php';</script>";
    }
}

// Update appointment payment status
if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $query = "UPDATE appointmenttb SET payment = '$status' WHERE contact = '$contact'";
    $result = pg_query($con, $query);

    if ($result)
        header("Location:updated.php");
}

// Display doctors
function display_docs()
{
    global $con;
    $query = "SELECT * FROM doctb";
    $result = pg_query($con, $query);

    while ($row = pg_fetch_array($result)) {
        $name = $row['name'];
        echo '<option value="' . $name . '">' . $name . '</option>';
    }
}

// Add a doctor
if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];
    $query = "INSERT INTO doctb (name) VALUES ('$name')";
    $result = pg_query($con, $query);

    if ($result)
        header("Location:adddoc.php");
}
?>
