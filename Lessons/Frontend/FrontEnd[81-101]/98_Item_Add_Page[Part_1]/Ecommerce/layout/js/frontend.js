$(function(){

   'use strict';
  
   // Switch Between Login & Signup
   
   $('.login-page h1 span').click(function(){
      $(this).addClass('selected').siblings().removeClass('selected');
    
      $('.login-page form').hide();
      
      $('.' + $(this).data('class')).fadeIn(100);

       // console.log('.' + $(this).data('class'));

   });
   

   //Trigger The Selectboxit
   $("select").selectBoxIt({
        autoWidth: false
   });



   // Hide Placeholder On Form Focus
   $('[placeholder]').focus(function(){
       
       $(this).attr('data-text', $(this).attr('placeholder'));
       $(this).attr('placeholder', '');

   }).blur(function(){

   	    $(this).attr('placeholder', $(this).attr('data-text'));
   });


   // Add Asterisk On Required Field 

   $('input').each(function(){

       if($(this).attr('required') === 'required'){

       	   $(this).after('<span class="asterisk">*</span>');
       }

   });


   // Confirmation Message On Button

   $('.confirm').click(function(){
         return confirm('Are You Sure?');
   });


 // Create Live Preview in New Ad Page

  $('.live-name').keyup(function(){

     // console.log($(this).val());
     $('.live-preview .caption h3').text($(this).val());

  });

  $('.live-desc').keyup(function(){

     $('.live-preview .caption p').text($(this).val());

  });


  $('.live-price').keyup(function(){

     $('.live-preview .price-tag').text('$' + $(this).val());

  });
  
  

});