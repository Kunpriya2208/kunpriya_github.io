<?php require_once('Connections/mysqli.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_mysqli, $mysqli);
$query_aomsin_rec_admin = "SELECT * FROM aomsin_system";
$aomsin_rec_admin = mysql_query($query_aomsin_rec_admin, $mysqli) or die(mysql_error());
$row_aomsin_rec_admin = mysql_fetch_assoc($aomsin_rec_admin);
$totalRows_aomsin_rec_admin = mysql_num_rows($aomsin_rec_admin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p align="center">ข้อมูลสมาชิก สทส.12</p>
<p align="center"><a href="insert.php">insert data</a></p>
<form id="form1" name="form1" method="post" action="search.php">
  <label for="search">
    <div align="center"></div>
  </label>
  <div align="center"></div>
</form>
<form id="form2" name="form2" method="post" action="search.php">
  <label for="search2">
    <div align="center">ค้นหา:
      <input type="text" name="search" id="search2" />
      <input type="submit" name="btn" id="btn" value="search" />
    </div>
  </label>
  <div align="center"></div>
</form>
<p align="center"><a href="logout.php">logout</a></p>
<table width="1000" border="1" align="center">
  <tr>
    <td><div align="center">id</div></td>
    <td><div align="center">uname</div></td>
    <td><div align="center">upass</div></td>
    <td><div align="center">myname</div></td>
    <td><div align="center">email</div></td>
    <td><div align="center">tel</div></td>
    <td>option</td>
    <td><div align="center">optsion</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_aomsin_rec_admin['id']; ?></td>
      <td><div align="center"><?php echo $row_aomsin_rec_admin['uname']; ?></div></td>
      <td><?php echo $row_aomsin_rec_admin['upass']; ?></td>
      <td><div align="center"><?php echo $row_aomsin_rec_admin['myname']; ?></div></td>
      <td><div align="center"><?php echo $row_aomsin_rec_admin['email']; ?></div></td>
      <td><div align="center"><?php echo $row_aomsin_rec_admin['tel']; ?></div></td>
      <td><a href="delete.php?id=<?php echo $row_aomsin_rec_admin['id']; ?>">delete</a></td>
      <td><a href="update.php?id=<?php echo $row_aomsin_rec_admin['id']; ?>">update</a></td>
    </tr>
    <?php } while ($row_aomsin_rec_admin = mysql_fetch_assoc($aomsin_rec_admin)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($aomsin_rec_admin);
?>
