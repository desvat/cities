$( document ).ready(function() {

  $( "button.btn-phone" ).click(function() {

    menuBtnStatus = $( "button.btn-phone svg" ).attr('class');
    menuBtnId = $( "button.btn-phone svg" );

      if (menuBtnStatus == 'menu-closed') {

        menuBtnId.removeClass().addClass('menu-open active');
        $( "#row-bottom" ).show();
        // $( "body" ).removeClass().addClass('disable-scrollbar');

      } else {
          menuBtnId.removeClass().addClass('menu-closed');
          $( "#row-bottom" ).hide();
          // $( "body" ).removeClass();

      }

    });

});