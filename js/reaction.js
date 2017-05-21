$(document).ready(function(){
  $(".reaction").on("click",function(){   // like click
	var data_reaction = $(this).attr("data-reaction");
	$(".like-details").html("You, roopa and 5 others");
	$(".like-btn-emo").removeClass().addClass('like-btn-emo').addClass('like-btn-'+data_reaction.toLowerCase());
	$(".like-btn-text").text(data_reaction).removeClass().addClass('like-btn-text').addClass('like-btn-text-'+data_reaction.toLowerCase()).addClass("active");;

	if(data_reaction == "Like")
	  $(".like-emo").html('<span class="like-btn-like"></span>');
	else
	  $(".like-emo").html('<span class="like-btn-like"></span><span class="like-btn-'+data_reaction.toLowerCase()+'"></span>');
  });
  
  $(".like-btn-text").on("click",function(){ // undo like click
	  if($(this).hasClass("active")){
		  $(".like-btn-text").text("Like").removeClass().addClass('like-btn-text');
		  $(".like-btn-emo").removeClass().addClass('like-btn-emo').addClass("like-btn-default");
		  $(".like-emo").html('<span class="like-btn-like"></span>');
		  $(".like-details").html("Arkaprava Majumder and 1k others");
		  
	  }	  
  })
  
  
});