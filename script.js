 /*------------------jquery start--------------*/
 $(document).ready(function() {

   /*------------------show/hide password start--------------*/
     $("#eye-show").on("click", function(){

      $(this).toggleClass("bi bi-eye bi bi-eye-slash");
      var userpasscode=$("#yourpassword");


if (userpasscode.attr("type")=="password") {
userpasscode.attr("type","text");
} else{
 userpasscode.attr("type","password");
}

     });
/*------------------show/hide password end--------------*/

// ------------start preloader---------------
 $("form").on("submit", function(){

        $("#preloader").show();
      $(".preloaderbg").show();
    
     });
        
    
// ------------end preloader---------------

 
// ----darkmode----START

if (localStorage.getItem("darkMode")==="enable") {
  $("body").addClass("dark-mode");
}




$(".changeTheme").click(function (e) {
  e.preventDefault();
  $("body").toggleClass("dark-mode");
  
  if($("body").hasClass("dark-mode")){
      localStorage.setItem("darkMode", "enable");
      
  }
  else {
      localStorage.removeItem("darkMode")
  } 
  
  
  
  
});

// --------darkmodeend---end











      // arrow direction in pages start

$("#arrowLeftSettings").on("click", function () {
  window.location.href = "seefriends.php";
});




$(".search-icon").on("click", function () {
  
  window.location.href = "seefriends.php";
});
$(".chatRoomLeft").on("click", function () {
  
  window.location.href = "seefriends.php";
});



$(".float-chart-btn").on("click", function () {
  $("#search_chat").focus();
  $(".search-icon").removeClass("bi-search");
$(".search-icon").addClass("bi-arrow-left");
  
});

// arrow direction in pages end  

// search friends start

$("#search_chat").on("keyup", function(){

    

  var displaySearch= $(this).val();

if (displaySearch.length>=1) {
$(".search-icon").removeClass("bi-search");
$(".search-icon").addClass("bi-arrow-left");
$.ajax({
  url:"scrutiny.php",
    type:"post",
     data:{
      displaySearch:displaySearch
    },
    success:function(response){
      $(".searchPreview").html(response);
    }
  });
}
else{
 $(".searchPreview").html(""); 
 $(".search-icon").addClass("bi-search");

}
  
   });
  //   search fiends ends  
    // start of profile upload
    const camera=document.getElementById("camera");
      camera.addEventListener("change",function(event) {
      const profilepixDisplay=document.getElementById("profilepixDisplay");
      profilepixDisplay.src= URL.createObjectURL(event.target.files[0]);
      
    });
  //   end of profile upload















  });
/*------------------Jquery end--------------*/

/*------------------AOS animation start--------------*/
    function aosInit() {
      AOS.init({
        duration: 600,
        easing: 'ease-in-out',
        once: true,
        mirror: false
      });
    }
    window.addEventListener('load', aosInit);
  

/*------------------AOS animation end--------------*/

/*------------------REMOVE SPACES IN USERNAME--------------*/

window.addEventListener("input",function(){
const removeSpaces=document.getElementById("yourUsername");

const removeSpace=document.getElementById("yourfullname");
const fullname=removeSpace.value.charAt(0).toUpperCase();
const nameremain=removeSpace.value.slice(1);
removeSpace.value=fullname+nameremain;



removeSpaces.value=removeSpaces.value.replace(/ /g,"");
const first=removeSpaces.value.charAt(0).toUpperCase();
const remaining=removeSpaces.value.slice(1).toLowerCase();
removeSpaces.value=first+remaining;

});
/*------------------REMOVE SPACES IN USERNAME--------------*/
