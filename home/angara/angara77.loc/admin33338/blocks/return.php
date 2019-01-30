<?php 

if ($result2 = mysql_query ("$sql")) { print "<p class='welcom_to_admin'>Прайслист успешно обновлен</p>";
$back = "<center><p class='welcom_to_admin'>Вернутся</p><a href='javascript:history.back(1)'<B class='welcom_to_admin'> назад</B></a>";
echo ($back);
}
?>
