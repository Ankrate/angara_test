<?php

$name = 'Генератор уценка 3730042624_OEM PORTER ПОРТЕР';
$i = preg_match('/уценка/ui',$name);

?>
<input  id="submit" type="submit" />
<div id="send1111">Ждем ответа</div>
<div id="freq">Ждем ответа</div>

 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
<script>
function foo(data) {
    console.log("City: ", data.city);
    console.log("Country: ", data.country.name);
    console.log("Latitude: ", data.location.latitude);
    console.log("Longitude: ", data.location.longitude);
    
    var city = data.city;
    return city;
}
</script>


<script src="//js.maxmind.com/js/geoip.js" type="text/javascript" ></script>
<script>
    setInterval(function() {
       $.ajax({
        type: "POST",
        url: "ajaxsearch.php",
        data: '',
        dataType: "json", // Set the data type so jQuery can parse it for you
        success: function (data) {
            $('#send').html(data);
                var htmlStr = '';
                //var city = '';
                $.each(data, function(k, v){
                getCity(v.query_ip);
                htmlStr += '<li>' + v.search_q + ' ' + v.query_ip + '</li>';
             });
   $("#send").html(htmlStr);
    }
});
     }, 1000 * 60 * 1); // where X is your every X minutes
//second query for most frequent queryes    
  $.ajax({
        type: "POST",
        url: "aj2.php",
        data: '',
        dataType: "json", // Set the data type so jQuery can parse it for you
        success: function (data) {
            $('#freq').html(data);
                var htmlStr = '';
                //var city = '';
                $.each(data, function(k, v){
                htmlStr += '<li>' + v.search_q + ' ' + v.count + '</li>';
             });
   $("#freq").html(htmlStr);
    }
});   
     
     
     
</script>


