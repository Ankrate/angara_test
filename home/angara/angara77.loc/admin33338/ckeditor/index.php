<?php
require_once 'app/views/tpl/header.php';
$p = new Articles;
//$p -> p($data);
?>



<div class="cotainer">
	<div class="row">

		<ol class="breadcrumb">
			<li>
				<a href="/admin">Админка</a>
			</li>

			<li class="active">
				Редактирование статей
			</li>
		</ol>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">
					<ul class="nav-stacked">
					    <li role="presentation" >
                            <a href="/admin/ckeditor/editart/"><i class="fa fa-plus adm_green"></i> &nbsp;&nbsp;Добавить статью</a>
                        </li>
					    <?php foreach($data2 as $d) :  ?>
						<li   >
							<a  class="a_text" onclick="if (! confirm('Точно удалить?')) return false;" href="/admin/ckeditor/deleteart/<?=$d[0] ?>/" data-toggle="tooltip" data-placement="left" title="Удалить статью" ><i class="fa fa-trash-o adm_red"></i> &nbsp;&nbsp;</a><a href="/admin/ckeditor/<?=$d[0] ?>/"> <?=$d[9] ?></a>
						</li>
						<?php endforeach ; ?>
						
						
					</ul>
				</div>
				<div class="col-md-1">
				    
				    
                        
				    </div>

				<div class="col-md-8">
					<div id="my_editor">
						<form method="post" id="apply-form">
<label>Название статьи</label>						    
<input id="angin" name="title" type="text" class="form-control field2" placeholder="Title" value="<?php if(isset($data[0][9])) echo $data[0][9];?>">
<label>Метатег description</label>						    
<input id="angin2" name="meta_d" type="text" class="form-control field2" placeholder="Meta description" value="<?php if(isset($data[0][1])) echo $data[0][1];?>">
<label>Ключевые слова</label>
<input id="angin3" name="meta_k" type="text" class="form-control field2" placeholder="Meta keywords" value="<?php if(isset($data[0][2])) echo $data[0][2];?>">
<label>Картинка на сайт</label>
<input id="angin4" name="img" type="text" class="form-control field2" placeholder="Image" value="<?php if(isset($data[0][8])) echo $data[0][8];?>">
<label>Картинка соц сети</label>
<input id="angin4" name="face_img" type="text" class="form-control field2" placeholder="Image Social Media" value="<?php if(isset($data[0][10])) echo $data[0][10];?>">
<label>Автор</label>
<input id="angin5" name="author" type="text" class="form-control field2" placeholder="Author" value="<?php if(isset($data[0][7])) echo $data[0][7];?>">
						    <label>Короткое описание</label>
						    <textarea id="editor" name="description" type="text" class="form-control field2" placeholder="Короткое описание" value=""><?php if(isset($data[0][3])) echo $data[0][3];?> </textarea>
						    <label>Текст статьи</label>
							<textarea  class="text_area" name="editor1" id="editor1" rows="10" cols="80">
                
                <?php if(isset($data[0][4])){echo $data[0][4];}?>
            </textarea>	
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>

</div>
<!-- conteiner-fluid -->
<?php
require_once 'app/views/tpl/footer.php';
?>
<script src="/admin/app/views/ckeditor/ckeditor.js"></script>
<script>
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor');
	//config.height = '500px';

</script>
<script>
	function myFunction() {
    if (confirm("Точно удалить?!"))
    {
       window.location = "/admin/ckeditor/deleteart/<?=$d[0] ?>/";
    }
    else {
        
    }
}
</script>

