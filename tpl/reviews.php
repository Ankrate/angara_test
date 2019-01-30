<?php 
 $user = new User();
 $rev = $user -> reviews($data[0][0][6]);
 
 ?>
 
<div class="well">

                    
            <?php foreach ($rev as $review) { ?>
                    <div class="row">
                        <div class="col-sm-12">
                             <?php $star_e = 5 - $review[3];
                             $star = $review[3]; 
                             ?>
                            <?php for ($i=0; $i < $star; $i++) { ?>
                                <span class="glyphicon glyphicon-star"></span>
                            <?php } ?>
                            <?php for ($i=0; $i < $star_e; $i++) { ?>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            <?php } ?>
                           <p><?=$review[1]?></p>
                            <span class="pull-right"></span>
                            <p><?=$review[2]?></p>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                </div>
                <div class="panel panel-default">
   <form class="bs-example bs-example-form" role="form" action="" method="post" >
       <input type="hidden" name="1c_id" value="<?=$data[0][0][6]?>">
      <div class="input-group col-xs-12">
         <input type="text" class="form-control" placeholder="Ваше имя ..." name="name">
          
      </div>
      <br>

      <div class="input-group col-xs-12">
         <textarea class="form-control " rows="2" placeholder="Ваш комментарий..." name="text"></textarea>
         
      </div>
      <br>
      <div class="container-fluid">
      <div class="input-group pull-right">
          <label for="" class="radio-inline">
                <span class="text-left glyphicon glyphicon-star"></span>
            </label>
        <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
            </label>
            <label class="radio-inline">
             <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
            </label>
            <label class="radio-inline">
             <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
            </label>
            <label class="radio-inline">
             <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 4
            </label>
            <label class="radio-inline">
             <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5"> 5
            </label>
            <label for="" class="radio-inline">
                <button class="btn btn-primary " type="submit">Оставить отзыв</button>
            </label>
      </div>
      </div>
   </form>
</div>