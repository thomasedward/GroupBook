$(document).ready(function () {

   'use strict';  // for error in js

// front use




   // start 
    // for hideing placeholder  in focus 
   $(".form-control").on("focus",function(){
        

    // hiding
    $(this).attr('data-text', $(this).attr('placeholder'));  // save val of placeholder in data-text
    $(this).attr('placeholder','');

    });
    // show again
    $(".form-control").on("blur",function(){
        
       
        $(this).attr('placeholder',$(this).attr('data-text'));  // back val of  data-text to placeholder
    
        });




});
