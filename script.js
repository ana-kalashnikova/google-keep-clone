$(document).ready(function(){
  $('.note').focusin(function(){
//disable the top form before the user signs in !????

    $('#close').toggle();
    $('.init').css({
    'height':'+=3em',
  });
  });

$('.note').focusout(function(){
  $('.init').css({ // shrink the top form
  'height':'-=3em'
}).val(''); //clear the form
  });


$('.signin').click(function(e){
  $('.user').toggle();
   // $('.blury').addClass('blur');
  e.preventDefault();
});

$('.signup').click(function(e){
  $('.register').toggle();
   // $('.blury').addClass('blur');
  e.preventDefault();
});

})
