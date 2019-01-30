#!/bin/bash
#Looking for files .JPG uppercase
for file in *.JPG 
do
	mv "$file"  "${file%.JPG}.jpg"
done

#Resize an image to 800x600

find . -type f  -iname "*.jpg" | xargs -l -i convert   -sample 800x600 {} {} ;

#putting watermark

find . -type f -iname "*.jpg" | xargs -l -i composite  -gravity center -watermark 10.0 watermark_big.png {} {} ;

#resizing image for thumbnails

find . -type f -iname "*.jpg" | xargs -l -i convert  -border 10 -bordercolor white  -background white -resize 350x250 {} /home/smb/tmb/{} ;

#sending images to masterhost

(rsync -rvz --update /home/smb/image_for_angara77/* u66745@u66745.ssh.masterhost.ru:/home/u66745/angara77.com/www/img/foto_parts/ ;

rsync -rvz --update /home/smb/tmb/* u66745@u66745.ssh.masterhost.ru:/home/u66745/angara77.com/www/img/tmb/ ;) 

