<?php require_once('Connections/mysqli.php'); ?>
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

$colname_aomsin_rce_search = "-1";
if (isset($_POST['search'])) {
  $colname_aomsin_rce_search = $_POST['search'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_aomsin_rce_search = sprintf("SELECT * FROM aomsin_system WHERE uname LIKE %s", GetSQLValueString("%" . $colname_aomsin_rce_search . "%", "text"));
$aomsin_rce_search = mysql_query($query_aomsin_rce_search, $mysqli) or die(mysql_error());
$row_aomsin_rce_search = mysql_fetch_assoc($aomsin_rce_search);
$totalRows_aomsin_rce_search = mysql_num_rows($aomsin_rce_search);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <table border="1">
    <tr>
      <td><div align="center">id</div></td>
      <td><div align="center">uname</div></td>
      <td><div align="center">upass</div></td>
      <td><div align="center">myname</div></td>
      <td><div align="center">email</div></td>
      <td><div align="center">tel</div></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_aomsin_rce_search['id']; ?></td>
        <td><?php echo $row_aomsin_rce_search['uname']; ?></td>
        <td><?php echo $row_aomsin_rce_search['upass']; ?></td>
        <td><?php echo $row_aomsin_rce_search['myname']; ?></td>
        <td><?php echo $row_aomsin_rce_search['email']; ?></td>
        <td><?php echo $row_aomsin_rce_search['tel']; ?></td>
      </tr>
      <?php } while ($row_aomsin_rce_search = mysql_fetch_assoc($aomsin_rce_search)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($aomsin_rce_search);
?>
