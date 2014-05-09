$("#contactus").submit(function(e) {
	e.preventDefault();
	$("#contactus")[0].reset();
})




$("#login-form").submit(function(e) {
	e.preventDefault();
	jQuery.ajax({
		url:"./php/login.php",
		type:"POST",
		data:$(this).serialize(),
		success:function(data){
			$("#login-form div:nth-child(1)").removeClass('has-error');
			$("#login-form div:nth-child(2)").removeClass('has-error');
	
			if(data=='emailerr'){
				$("#message").html("User Not found Please register");
					$("#login-form div:nth-child(1)").addClass('has-error');
			}
			else if(data=='passerr'){
				$("#message").html("Password didn't matched. ");
				$("#login-form div:nth-child(2)").addClass('has-error');
			}
			else if(data=='done'){
				$("#message").html("Logged in successfully");
				$("#login-form")[0].reset();
				location.reload();
			}

		},
		error:function(){
			alert("Network Error");
		}
	})
});
$("#register-form").submit(function(e) {
	e.preventDefault();
	jQuery.ajax({
		url:"./php/register.php",
		type:"POST",
		data:$(this).serialize(),
		success:function(data){
			$("#register-form div:nth-child(1)").removeClass('has-error');
			$("#register-form div:nth-child(2)").removeClass('has-error');
			$("#register-form div:nth-child(3)").removeClass('has-error');
			$("#register-form div:nth-child(4)").removeClass('has-error');
			if(data=='emailerr'){
				$("#message").html("User already present");
					$("#register-form div:nth-child(2)").addClass('has-error');
			}
			else if(data=='passnotmatch'){
				$("#message").html("Password didn't matched");
				$("#register-form div:nth-child(4)").addClass('has-error');
				$("#register-form div:nth-child(3)").addClass('has-error');
			}
			else if(data=='passworderr'){
				$("#message").html("Password should be of atleast 8 characters");
				$("#register-form div:nth-child(4)").addClass('has-error');
				$("#register-form div:nth-child(3)").addClass('has-error');
			}
			else if(data=='done'){
				$("#register-form")[0].reset();
				$("#message").html("You have been successfully registered.. Please login to continue");
			}
		},
		error:function(){
			alert("Network Error");
		}
	})
});
$("#forgetpassword-form").submit(function(e) {
	e.preventDefault();
	jQuery.ajax({
		url:"./php/forget.php",
		type:"POST",
		data:$(this).serialize(),
		success:function(data){
			if(data=='emailerr')
				$("#message").html("Email not found in database");
			else if(data=='done'){
				$("#forgetpassword-form")[0].reset();
				$("#message").html("Your password has been sent to your email id");
			}
			console.log(data);

		},
		error:function(){
			alert("Network Error");
		}
	})
});

$("#edit-photo").click(function(){
	$("#logo-upload").click();
})
function editpic(){
	var formData = new FormData($('#imgup')[0]);
	$.ajax({
		url: 'php/logo-upload.php',  //Server script to process data
		type: 'POST',
		success: function(data){
			if(data=="done")
				location.reload();
			else
				alert(data);
		},
		error: function(data){
			alert("error");
		},
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	});
}