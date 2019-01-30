<?php
if(isset($_POST['sr']))
{
    $v = $_POST['sr'];
}
else {$v = '';
}
?>

</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
				<form class="well" method="post" action = "<?php echo '/search/' ;?>">
					<div class="input-group">
						<input name="sr" type="text" class="form-control input-lg" id="pwd" placeholder="Поиск по номеру, названию запчасти..." value="<?=$v?>">
						<span class="input-group-btn">
							<button  type="button submit" class="btn btn-primary input-lg">
								ПОИСК
							</button> </span>
					</div>
					<!-- <span class="help-block">Введите номер запчасти или название...</span> -->
				</form>
				</div>
			</div><!-- end row -->
			</div> <!-- end container -->