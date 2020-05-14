$(document).ready(function(){

  $('.note').focusin(function(){
//disable the top form before the user signs in !????
    $('.init').css({
    'height':'+=3em',
  });
  });

$('.note').focusout(function(){
  $('.init').css({ // shrink the top form
  'height':'-=3em'
  });
// submit when click outside the form?????
  // $('.close').submit(); //form class
  // $('.init').val('');
  });


$('.signin').click(function(e){
  $('.user').toggle();
  e.preventDefault();

});

$('.signup').click(function(e){
  $('.register').toggle();
  e.preventDefault();
  $('.blur').css('display','flex');
});
$('.register').submit(function(i){
  i.preventDefault();
  $('.blur').hide();
});

$('.formCollection').focusin(function(){
  $('.txtareaCollection').css({
    'position':'fixed',
    'top':'20%',
    'left':'40%',
    'width':'20em',
    'height':'15em',
    'z-index':'3'
  });

});
});
