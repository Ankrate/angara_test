#!/bin/bash
#MAIL=angara99@gmail.com


#/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/PhpExcelReader/angara_com.php;
#/usr/local/php5/bin/php-cli /home/u66745/angara77.com/www/admin/PhpExcelReader/bel.php;


#/usr/local/php5/bin/php-cli /home/u66745/angara77.com/www/admin/PhpExcelReader/ozer.php;
#/usr/local/php5/bin/php-cli /home/u66745/angara77.com/www/admin/PhpExcelReader/kare.php;

function price_insert {
    echo "Script started successfully"
    if (/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/PhpExcelReader/angara_com.php;); then
        echo "Price inserted  successfully"
    else
        echo "Error: Price didn't inserted!"
    fi

}
price_insert | /usr/bin/mail -s "Backup Status" angara99@gmail.com
