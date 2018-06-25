
	function scrollBottom(){
		chatbox = document.getElementById('chatbox');
		chatbox.scrollTop = chatbox.scrollHeight;
	}

	$(document).ready(function(){
		$("#chatbox").css("top",$("#header").css("height"));
		$("#senderText").css("bottom",$("#footer").css("height"));
		$("#chatbox").css("bottom",parseInt($("#footer").css("height"))+parseInt($("#senderText").css("height")));
		$("#chatbox").css("padding-bottom",$("#senderText").css("height"));
		$("#chatbox").fadeIn();
		toBottom();


		var cron = setInterval(getUpdate,500);


		$('#username').keydown(function (e) {
		  if (e.keyCode == 13) {
		    // Ctrl-Enter pressed
			$("#myModal").fadeOut();
		    setUsername(); 
		  }
		});


		$("#openModal").click(function(){
			$("#myModal").fadeIn();
		})

		$("#myModal").click(function(event){

			$("#myModal").fadeOut();
		}).children().click(function(e){ return false;});


		$('#senderText').keydown(function (e) {
		  if (e.ctrlKey && e.keyCode == 13) {
		    sendMessage();
		  }
		});





		// $(".chat-box").click(function(){
			
		// 	// $(".chat-box").children(".msg-details").hide(200)
		// 	$(this).children(".msg-details").toggle(200);
		// })

		// $(".chat-box").hover(function(){
		// 	$(this).click();
		// });



	});

function toggleFullscreen(){
	if(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement)
		exitFullscreen();
	else activateFullScreen(document.documentElement);
}


   function activateFullScreen(element) {
  if(element.requestFullScreen) {
    element.requestFullScreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  }
}


function exitFullscreen() {
  if(document.cancelFullScreen) {
    document.cancelFullScreen();
  } else if(document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if(document.webkitCancelFullScreen) {
    document.webkitCancelFullScreen();
  }
}
	function toBottom(){
		$("#chatbox").animate({ scrollTop : $("#chatbox").prop('scrollHeight')},1000,'swing');
	}




	function getUpdate(){
			data = { 'action' : "getUpdate"};
			$.ajax({
	        url: "getUpdate",
	        type : "post",
	        // dataType: "json",
	        data: data,
	        success: function(result){
	        	if(result!="[]"){
	        		result = JSON.parse(result);
		        	result.forEach(function(row){
		        		if(row.type == "nmc"){
		        			$("#messages").append('<div class="alert alert-info text-center">'+row.message+'</div>')
		        		}
		        		else{
		        			if(row.username == $("#username").val()){
		        					$("#messages").append('<div class="chat-box right '+theme+'">'+
								  '<p>'+row.message+'</p>'+
								  '<span class="msg-details">'+
								  	'<span class="user">'+row.username+'</span>'+
								  	'<span class="msg-time">'+row.timestamp+'</span>'+
								  '</span></div>');
		        			}
		        			else{
		        					$("#messages").append('<div class="chat-box '+theme+'">'+
								  '<p>'+row.message+'</p>'+
								  '<span class="msg-details">'+
								  	'<span class="user">'+row.username+'</span>'+
								  	'<span class="msg-time">'+row.timestamp+'</span>'+
								  '</span></div>');

		        			}
		        		}
		        	});
		        	toBottom();
	        	}
	        	
	            // return JSON.parse(result);
	            // return JSON.stringify({ status : 500, message : "server error" });
	        },
	        error:function(x,y,z){	        }
	    });
	}
	function setUsername(){
			data = { 'username' : $("#username").val()};
			$.ajax({
	        url: "setUsername",
	        type : "post",
	        // dataType: "json",
	        data: data,
	        success: function(result){
	        	// alert(result);
	        	// response = JSON.parse(result);
	        	// $("#messages").append(response.message);
	        	// toBottom();
	        },
	        error:function(x,y,z){
	        	$("#messages").append('<div class="alert alert-info text-center">Server Error!</div>');
		        	toBottom();
	        }
	    });
	}
	function sendMessage(){
			data = { 'message' : $("#senderText").val()};
			$.ajax({
	        url: "sendMessage",
	        type : "post",
	        // dataType: "json",
	        data: data,
	        success: function(result){
	        	response = JSON.parse(result);
	        	console.log(response.message);
	        	// if(response.status==500)
	        	// {
	        	// 	$("#messages").append(response.message);
	        	// 	$("#senderText").val(response.additional);
	        	// }
	        },
	        error:function(x,y,z){
	        	$("#messages").append('<div class="alert alert-info text-center">Server Error!</div>');
		        	toBottom();
	        }
	    });
		    $('#senderText').val("").focus();
	}

	function setTheme(themeNo){
		if(themeNo>=0&&themeNo!=-1)
		{
			data = { 'theme' : themeNo};
			$.ajax({
		        url: "setTheme",
		        type : "post",
		        // dataType: "json",
		        data: data,
		        success: function(result){
		        	response = JSON.parse(result);
		        	console.log(response.bg);
		        	$(".chat-box").removeClass (function (index, className) {
					    return (className.match (/(^|\s)color\S+/g) || []).join(' ');
					});
					theme = response.theme;
		        	$(".chat-box").addClass(response.theme);
		        	$("#messages").append('<div class="alert alert-info text-center">'+response.message+'</div>');
		        	toBottom();
		        },
		        error:function(x,y,z){
		        	$("#messages").append('<div class="alert alert-info text-center">Server Error!</div>');
		        	toBottom();
		        }
	    	});
		}
		// else alert("Fuck You!");
			
	}

	function uncleanURL(url){
		// return "index.php?"+url;
		return url;
	}
	// $("#senderText").click(function(){
	// 	scrollBottom();
	// 	alert($("#chatbox").scrollTop()+" ed "+$("#chatbox")[0].scrollHeight);

	// });