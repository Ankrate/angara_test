#!/bin/bash
#MAIL=angara99@gmail.com

/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/PhpExcelReader/hyundaiporter_insert.php;
/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/PhpExcelReader/lib/insert_special.php;

function price_insert {
    echo "Script started successfully"
	if (/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/PhpExcelReader/hyundaiporter_insert.php);
	then
        echo "Price hyundaiporter inserted  successfully"
elif (/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/PhpExcelReader/lib/insert_special.php);
	then
	 echo "Price hyundaiporter specials inserted  successfully"
else
        echo "Error: Price hyundaiporter didn't inserted!"
    fi

}
price_insert | /usr/bin/mail -s "Backup Status" angara99@gmail.com

