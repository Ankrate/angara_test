#!/bin/bash
#MAIL=angara99@gmail.com


function price_insert {
    if (/usr/local/bin/php /home/u66745/angara77.com/www/admin33338/insert/index.php;); then
        echo " Insert Success "
    else
        echo "Error: Price didn't inserted!"
    fi

}
price_insert | /usr/bin/mail -s "angara77.com: " angara99@gmail.com
