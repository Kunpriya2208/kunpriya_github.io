<?php require_once('Connections/mysql.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE std_it12 SET code_std=%s, name_std=%s, dep_std=%s, tel_std=%s WHERE id=%s",
                       GetSQLValueString($_POST['code_std'], "text"),
                       GetSQLValueString($_POST['name_std'], "text"),
                       GetSQLValueString($_POST['dep_std'], "text"),
                       GetSQLValueString($_POST['tel_std'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_mysql, $mysql);
  $Result1 = mysql_query($updateSQL, $mysql) or die(mysql_error());

  $updateGoTo = "admin1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_aomsin = "-1";
if (isset($_GET['id'])) {
  $colname_aomsin = $_GET['id'];
}
mysql_select_db($database_mysql, $mysql);
$query_aomsin = sprintf("SELECT * FROM std_it12 WHERE id = %s", GetSQLValueString($colname_aomsin, "int"));
$aomsin = mysql_query($query_aomsin, $mysql) or die(mysql_error());
$row_aomsin = mysql_fetch_assoc($aomsin);
$totalRows_aomsin = mysql_num_rows($aomsin);

mysql_free_result($aomsin);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Code_std:</td>
      <td><input type="text" name="code_std" value="<?php echo htmlentities($row_aomsin['code_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Name_std:</td>
      <td><input type="text" name="name_std" value="<?php echo htmlentities($row_aomsin['name_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Dep_std:</td>
      <td><input type="text" name="dep_std" value="<?php echo htmlentities($row_aomsin['dep_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tel_std:</td>
      <td><input type="text" name="tel_std" value="<?php echo htmlentities($row_aomsin['tel_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_aomsin['id']; ?>">
</form>
<p>&nbsp;</p>
