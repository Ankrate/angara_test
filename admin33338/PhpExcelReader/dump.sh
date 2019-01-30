#!/bin/bash

NOW=$(date +"%Y-%m-%d");

mysqldump -uu66745 -pcon9entiotai -h u66745.mysql.masterhost.ru --opt --all-databases | gzip -c | ssh manhee@angara77.org 'cat > /home/manhee/BackupsFromSites/$NOW.dump_all.sql.gz';

