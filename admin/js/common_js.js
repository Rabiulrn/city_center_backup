$(window).scroll(function(){
	var width = $('.left_side_bar').width();
	// if ($(this).scrollTop() > 150) {
	if ($(this).scrollTop() > 400) {
	    $('#left_all_menu_con').addClass('fixed_top');
	    $('#left_all_menu_con').css({'width': width, 'z-index': '9999'});
	} else {
	    $('#left_all_menu_con').removeClass('fixed_top');
	    $('#left_all_menu_con').css('width', width);
	    // alert($(this).scrollTop());
	}

	
});



//onvertical scroll top left position all page
var prevTop = 0;
$(document).scroll( function(evt) {
    var currentTop = $(this).scrollTop();
    if(prevTop !== currentTop) {
        prevTop = currentTop;
        // console.log("I scrolled vertically.");
        if ($(this).scrollTop() == 0) {
			window.scrollTo(0, 0);
		}
    }
});



//Delete edit not permission dialogue
$(document).on('click', '.edPermit', function(event){
    event.preventDefault();
    ConfirmDialog('You have no permission edit/delete this data !');
    function ConfirmDialog(message){
        $('<div></div>').appendTo('body')
                        .html('<div><h4>'+message+'</h4></div>')
                        .dialog({
                            modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                            width: '40%', resizable: false,
                            position: { my: "center", at: "center center-20%", of: window },
                            buttons: {
                                Ok: function () {
                                    $(this).dialog("close");
                                },
                                Cancel: function () {
                                    $(this).dialog("close");
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
    };
});



//on delete password verification
$(document).on("click", ".kajol_close, .cancel", function(){
    $("#verifyPasswordModal").hide();
});