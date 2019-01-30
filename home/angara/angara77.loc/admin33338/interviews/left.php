<nav >
<ul class="left-adm-bar">
	
	<li class="nav-item">
        <a class="nav-link pl-0" href="index.php" data-toggle="tooltip" data-placement="bottom" title="Список контактов"><i class="fas fa-address-book"></i></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pl-0" href="people_edit.php" data-toggle="tooltip" data-placement="bottom" title="Создать контакт"><i class="fab fa-creative-commons-by"></i></a>
    </li>
<li>
		<a class="nav-link pl-0" href="schedule.php" data-toggle="tooltip" data-placement="bottom" title="Список задач"><i class="fas fa-tasks" ></i></a>
	</li>

	
	<li>
		<a class="nav-link pl-0" href="all_tasks.php" data-toggle="tooltip" data-placement="bottom" title="Просроченные задачи"><span><i class="fas fa-bell"></i><span id="result1" class="badge badge-notify"></span></span></a>
	</li>
	<li>
        <a class="nav-link pl-0" href="people_archive.php" data-toggle="tooltip" data-placement="bottom" title="Резюме в архиве"><i class="fas fa-archive"></i></a>
    </li>
</ul>
</nav>

<script>
    function ajaxCall() {
    //$("button").click(function(){
    $.post("notify.php", function(data, status){
       $('#result1').html(data)
       if($.trim(data) == 0){
           //console.log('yes');
           $('#result1').empty();
       }
       
    //});
});
}
ajaxCall();
setInterval(ajaxCall, 300000); //300000 MS == 5 minutes
</script>