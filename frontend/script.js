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
  });

$('.signin').click(function(e){
  $('.signinForm').toggle();
  $('.note').toggle();
  e.preventDefault();
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
  $('.buttonCollection').css({
// move the button
  'position':'fixed',
  'z-index':'3',
  'left':'57%',
  'bottom':'48%'
  });
  // $('.blur').css('display','flex');
  // $('.formCollection').submit(function(i){
  // i.preventDefault();
  // $('.blur').hide();
  // });
});

});
