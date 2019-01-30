#!/bin/bash
#Looking for files .JPG uppercase

#find . -type f -type f -atime -1 -iname "*.JPG" | xargs -l -i mv {}  {%.jpg} ;
for file in *.JPG 
do
       mv "$file"  "${file%.JPG}.jpg"
done

#for i in `ls *.jpg`
#do
#    echo $i
#    composite  -watermark 10.0 watermark_big.png $i $i
#done



#find . -type f -type f -atime -1 -iname "*.jpg" | xargs -l -i convert  -border 10 -bordercolor white  -background white -resize 350x250 {} /home/smb/tmb/{} ;

#cd /home/smb/tmb/ ;   

#for i in `ls *.jpg`
#do
#    echo $i
#    composite  -watermark 10.0 watermark.png $i $i
#done

#rsync -rvz --update /home/smb/image_for_angara77/* u66745@u66745.ssh.masterhost.ru:/home/u66745/angara77.com/www/img/#foto_parts/ ;

#rsync -rvz --update /home/smb/tmb/* u66745@u66745.ssh.masterhost.ru:/home/u66745/angara77.com/www/img/tmb/ ;

