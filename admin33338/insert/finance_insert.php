<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name'])) {
    if($_SESSION['user'] != 'Olesya' OR $_SESSION['user'] != 'admin'){
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/FinanceInsert.php');


//p($_POST);
$obj = new FinanceInsert;
$cur_date = date('Y-m-d');
if($_GET['action'] == 'budget_edit' OR @$_POST['action'] == 'budget_edit'){
    $obj->company_id = $_GET['com_id'];
    $company = $obj->company_select();
    $fields = $obj->fields();
    $fields_incom = $obj->fields_incom();
    $obj2 = new FinanceInsert;
    $obj2->table = 'adm_companies_incom_value';
    $obj2->table2 = 'adm_companies_incom_name';
    
    //p($company);
   // p($fields);
}

if(@$_GET['action'] == 'insertbudget' OR @$_POST['action'] == 'insertbudget'){
    $obj->data = $_POST;
    $obj -> table = 'adm_companies_budget_value';
    
    //$obj->data = $_GET['value'];
    if($obj->budget_work()){
    header('Location:/admin33338/insert/finance_insert.php?action=budget_edit&com_id='. $obj->company_id );
    //echo 'good';
    }
}elseif(@$_POST['action'] == 'insertincom'){
        $obj2->company_id = $_GET['com_id'];
        $obj2 -> table = 'adm_companies_incom_value';
        $obj2->data = $_POST;
        if($obj2->budget_work()){
            header('Location:/admin33338/insert/finance_insert.php?action=budget_edit&com_id='. $obj->company_id );
        }
    
}
//p($_POST);
//p($obj2->data);
//$obj->data = $_POST;
//$obj->rebuild_array();
//p($user);
//$data = $obj->get_data();
//p($plan);
$date = date('Y-m-d H:i:s');

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>

    
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            
            
            <?php if($_GET['action'] == 'budget_edit'):?>
            <div class="row">
                
               <div class="col-md-12">
                   
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Бюджет Расходов Компании <?=$company[0]['name']?></caption>
                            <thead>
                                <tr>
                                    <th>Article</th>
                                    
                                    <?php for($i=1;$i<=12;$i++):?>
                                        <th>
                                        <?=date('Y')?>-<?=$i?>-01
                                        </th>
                                        <?php endfor?>
                                        
                                </tr>
                                <tr>
                                    <th>Сумма</th>
                                    <?php for($i=1;$i<=12;$i++):?>
                                        
                                        <th>
                                        <?php 
                                        $obj->table_summ = 'adm_companies_budget_value';
                                        $summ = $obj->budget_summ(date('Y') . "-" .$i. "-01", $obj->company_id);
                                            echo number_format($summ[0]['summa']);
                                        ?>
                                        </th>
                                        <?php endfor?>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($fields as $sal):?>
                                    <form action="" method="post">
                                        <tr>
                                            <tr>
                                                <td><b><?=$sal['name']?></b></td>
                                                <?php for($i=1;$i<=12;$i++):?>
                                                <?php
                                                    $mydate = date('Y') . '-' . $i . '-01';
                                                    //echo $mydate;
                                                    $pla = $obj->get_budget($sal['id'], $mydate, $obj->company_id);
                                                    //p($pla);
                                                ?>
                                            
                                             
                                        <td><input type="text" class="form-control" name="ex_value[<?=$mydate?>][<?=$sal['id']?>][<?=@$pla[0]['id']?>]"   value="<?=number_format($pla[0]['value'])?>" placeholder="План в рублях">
                                            
                                            <input type="hidden" class="form-control" name="field_id"  value="<?=$sal['id']?>">
                                            <!-- <input type="text" class="form-control" name="plan[<?=$mydate?>][plan2][]"   value="<?=$pla[0]['plan2']?>" placeholder="План в рублях"> -->
                                        </td>
                                        <?php endfor?>
                                        
                                        
                                        
                                    <input type="hidden" class="form-control" name="action"  value="insertbudget">
                                    <input type="hidden" class="form-control" name="date"  value="<?=$cur_date?>">
                                    <input type="hidden" class="form-control" name="company_id"  value="<?=$obj->company_id?>">
                                    
                                     </tr>
                                </tr>
                                
                                <?php endforeach?>
                                
                                <td class="newuser"><button type="submit" class="btn btn-success">Сохранить</button></td>
                                </form>
                                
                            </tbody>
                        </table>
                           
               </div> 
            </div>
            <div class="row">
               <div class="col-md-12">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">План Доходов Компании <?=$company[0]['name']?></caption>
                            <thead>
                                <tr>
                                    <th>Article</th>
                                    
                                    <?php for($i=1;$i<=12;$i++):?>
                                        <th>
                                        <?=date('Y')?>-<?=$i?>-01
                                        </th>
                                        <?php endfor?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($fields_incom as $in):?>
                                    <form action="" method="post">
                                        <tr>
                                            <tr>
                                                <td><b><?=$in['name']?></b></td>
                                                <?php for($i=1;$i<=12;$i++):?>
                                                <?php
                                                    $mydate = date('Y') . '-' . $i . '-01';
                                                    $pla2 = $obj2->get_incom($in['id'], $mydate, $obj->company_id);
                                                ?>
                                        <td><input type="text" class="form-control" name="ex_value[<?=$mydate?>][<?=$in['id']?>][<?=@$pla2[0]['id']?>]"   value="<?=number_format($pla2[0]['value'])?>" placeholder="План в рублях">
                                            <!-- <input type="text" class="form-control" name="plan[<?=$mydate?>][plan2][]"   value="<?=$pla[0]['plan2']?>" placeholder="План в рублях"> -->           
                                        </td>
                                        <?php endfor?>
                                    <input type="hidden" class="form-control" name="action"  value="insertincom">
                                    <input type="hidden" class="form-control" name="date"  value="<?=$mydate?>">
                                    <input type="hidden" class="form-control" name="company_id"  value="<?=$obj->company_id?>">
                                     </tr>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                          <td class="newuser"><button type="submit" class="btn btn-success">Сохранить</button></td>
                                </form> 
               </div> 
            </div>
            <?php endif?>
            
            <!-- add plans percentage -->
            
            
        </div>
            
            
    </body>
</html>