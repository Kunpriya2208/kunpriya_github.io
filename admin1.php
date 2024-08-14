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

mysql_select_db($database_mysqli, $mysqli);
$query_member = "SELECT * FROM std_it12";
$member = mysql_query($query_member, $mysqli) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <p>ข้อมูลนักเรียน นักศึกษา  </p>
  <table border="1">
    <tr>
      <td width="78"><div align="center">id</div></td>
      <td width="123"><div align="center">code_std</div></td>
      <td width="207"><div align="center">name_std</div></td>
      <td width="125"><div align="center">dep_std</div></td>
      <td width="107"><div align="center">tel_std</div></td>
      <td width="56"><div align="center">option</div></td>
      <td width="56"><div align="center">option</div></td>
    </tr>
    <?php do { ?>
      <tr>
        <td><div align="center"><?php echo $row_member['id']; ?></div></td>
        <td><div align="center"><?php echo $row_member['code_std']; ?></div></td>
        <td><div align="center"><?php echo $row_member['name_std']; ?></div></td>
        <td><div align="center"><?php echo $row_member['dep_std']; ?></div></td>
        <td><div align="center"><?php echo $row_member['tel_std']; ?></div></td>
        <td><div align="center"><a href="delete.php?id=<?php echo $row_member['id']; ?>">delete</a></div></td>
        <td><div align="center"><a href="update.php?id=<?php echo $row_member['id']; ?>">update</a></div></td>
      </tr>
      <?php } while ($row_member = mysql_fetch_assoc($member)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($member);
?>
