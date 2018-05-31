<?php

session_start();

if(!isset($_SESSION['Admin_Logged_In']) ||  $_SESSION['Admin_Logged_In'] != "YES"){
	echo "Restricted access.";
	exit();
}

include '../../../config.php';
include 'conn.php';
include 'functions.php';

$is_caller = true;
include 'my_info.php';
if(!check_perms('nominations', $account_permissions)){die('Unauthorised access.');}

$group = (int)$_GET['id'];
$xls = '';
$counter = 0;

$category_name = '';
$sqlquery = mysql_query("SELECT title FROM categories WHERE id=" . $group);
while($row = mysql_fetch_array($sqlquery)){ 
	$category_name = $row['title'];
}

$sqlquery = mysql_query("SELECT * FROM nominations WHERE category_id=" . $group . " ORDER BY id DESC");
while($row = mysql_fetch_array($sqlquery)){ 
	$counter++;
	$xls .= '<tr' . ($counter % 2 == 0 ? ' bgcolor="#FFFFFF"' : ' bgcolor="#CCCCFF"') . '>';
	$xls .= '<td valign="top">' . date('d F Y', $row['date_created']) . '</td>';
	$xls .= '<td valign="top">' . $row['n_name'] . '</td>';
	$xls .= '<td>' . nl2br($row['n_reason']) . '</td>';
	$xls .= '</tr>';
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=nominations_" . sift($category_name, 'ALPHA') . ".xls;");
header("Pragma: no-cache");
header("Expires: 0");

echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
echo '<head>';
echo '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
echo '<meta name=ProgId content=Excel.Sheet><meta name=Generator content="Microsoft Excel 9">';
echo '<!--[if gte mso 9]><xml>';
echo '<x:ExcelWorkbook>';
	echo '<x:ExcelWorksheets>';
		echo '<x:ExcelWorksheet>';
			echo '<x:Name>Nominations - ' . $category_name . '</x:Name>';
			echo '<x:WorksheetOptions>';
				echo '<x:Selected/><x:ProtectContents>False</x:ProtectContents><x:ProtectObjects>False</x:ProtectObjects><x:ProtectScenarios>False</x:ProtectScenarios>';
					echo '<x:Print>';
						echo '<x:ValidPrinterInfo/>';
					echo '</x:Print>';
				echo '</x:WorksheetOptions>';
			echo '</x:ExcelWorksheet>';
		echo '</x:ExcelWorksheets>';
		echo '<x:ProtectStructure>False</x:ProtectStructure><x:ProtectWindows>False</x:ProtectWindows>';
	echo '</x:ExcelWorkbook>';
echo '</xml><![endif]--> ';
echo '</head>';
echo '<body><table x:str><tr><td><strong>Date</strong></td><td><strong>Nomination</strong></td><td><strong>Reason</strong></td></tr>';
echo $xls;
echo '</table></body></html>';

?>