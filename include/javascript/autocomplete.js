

$(function(){
  $('#porter').autocomplete({
    source: "/include/autocomplete.php",
    minLength: 2,
    select: function (event, ui) {
    	event.preventDefault();
        $("#porter").val(ui.item.label); // display the selected text
        $("#my_id").val(ui.item.value);
        $("#car").val(ui.item.value); // save selected id to hidden input
        $("#checkbox_model").val(ui.item.option); // save option in select
        $(".search-form").submit();
    }
    
    
  });
});