$(function(){
  $('#porter').autocomplete({
    source: "blocks/autocomplete.php",
    minLength: 2,
    select: function (event, ui) {
    	event.preventDefault();
        $("#porter").val(ui.item.label); // display the selected text
        $("#my_id").val(ui.item.value); // save selected id to hidden input
    }
    
    
  });
});


$(function(){
  $('#all').autocomplete({
    source: "blocks/autocomplete_all.php",
    minLength: 2,
    select: function (event, ui) {
    	event.preventDefault();
        $("#all").val(ui.item.label); // display the selected text
        $("#my_id2").val(ui.item.value); // save selected id to hidden input
    }
  });
});