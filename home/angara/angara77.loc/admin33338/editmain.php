<?php
ob_start();
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ('lock.php');
//print_r($_POST);
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/core.php");
if (isset($_GET['id'])) {$id =  $_GET['id'];}
else $get_id = 1;

$data = adm_main_all();
//p($data);

$carnames = left_side_car();
//p($_POST);
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <div class="admin_header">ANGARA Co.LTD., from 2001 year.</div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    
                    <ul class="list-unstyled">
                                <li><button type="button" class="btn btn-primary btn-xs"><a href="/admin33338/">В админку</a></button></li>
                                <li><button type="button" class="btn btn-success btn-xs"><a href="../">На сайт</a></button></li>
                                <li><button type="button" class="btn btn-info btn-xs"><a href="editmain.php">Новая</a></button></li>
                                
                                <?php foreach ($data as $line) {?>
                                    <li><a style="color: #2c3e50;" href="?car_id=<?=$line['car_id']?>"><?=$line['car_id']?>. <?=$line['title']?></a></li>
                                <?php }?>
                                <!-- <li><a href="/admin33338/insert/">Вставить прайс</a></li> -->
                   </ul>
                
                
                </div>
           
            
            <?php 
            
            
            if (isset($_POST['text'])) {
               
                $result = adm_main_update($_POST);
                header("Location: ".$_SERVER['REQUEST_URI']);
        }
            
                
                $text = @adm_main($_GET['car_id']);
                //p($text);
                ?>
            
            
            
    <div class="col-md-8">
        
        <div id="my_editor">    
        <form method="post" class="form-art">
            <label for="exampleInputEmail1">Title</label>
            <input class="form-control" name="title"  placeholder="Title" value="<?=@$text[0]['title']?>">
            <label for="exampleInputEmail1">Description</label>
            <input class="form-control" name="descr"  placeholder="Meta description" value="<?=@$text[0]['descr']?>">
            <label for="exampleInputEmail1">H1</label>
            <input class="form-control" name="h1"  placeholder="H1" value="<?=@$text[0]['h1']?>">
            <label for="exampleInputEmail1">IMG</label>
            <input class="form-control" name="img"  placeholder="Image" value="<?=@$text[0]['img']?>">
            <label>Машина: 1-Портер, 2-HD, 3-Starex</label>
            <input class="form-control" name="car_id"  placeholder="Машина 1-Портер, 2-HD, 3-Starex" value="<?=@$text[0]['car_id']?>">
            
               <!--  <div class="radio radio-inline">
                  <label>
                    <input type="radio" name="car" id="inlineRadio1" value="1" checked>
                    Porter
                  </label>
                </div>
                <div class="radio radio-inline">
                  <label >
                    <input type="radio" name="car" id="inlineRadio2" value="2">
                    HD
                  </label>
                </div>
                <div class="radio radio-inline">
                  <label >
                    <input type="radio" name="car" id="inlineRadio3" value="3">
                    Starex
                  </label>
                </div> -->
            
            <input type="hidden" class="form-control" name="cat_id"  placeholder="Category Id" value="<?=@$_GET['id']?>">
            <input type="hidden"  class="form-control" name="id" value="<?=@$text[0]['id']?>">
            
            <textarea  class="text_area" name="text" id="editor1" rows="10" cols="80">
                
                <?=@$text[0]['text']?>
            </textarea>
            
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                //config.height = '500px';
                
            </script>
        </form>
            </div>      
            </div>
    
 </div><!-- ROW -->
</div><!--  container -->
  







</body>
</html>


