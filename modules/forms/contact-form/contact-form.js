
//Форма в контактах
$(document).on("click","#contacts_send",function(){


		var name = $("#contacts_name").val();
		var email = $("#contacts_email").val();
		var text = $("#contacts_text").val();

		if(!email)
		{
			$("#contacts_email").parent("label").css("color","red");
		}else{
			$("#contacts_email").parent("label").css("color","#777");
		}

		if(email)
		{
			var r1 = new RegExp("\x27+","g");
			var r2 = new RegExp("\x22+","g");
			email = email.replace(r1, " ");
			email = email.replace(r2, " ");

			text = text.replace(r1, " ");
			text = text.replace(r2, " ");

			dataString = {sendformcontacts:1,name:name,email:email,text:text};
			$.ajax({
				type:"POST",
				dataType:'json',
				url:'/modules/forms/contact-form/contact-form_cender.php',
				data:dataString,
				cache:false,
				success:function(html){
					Close_Pop_Up('.PopUp');
					SetMetrika('contact_form');
					Show_Pop_Up(".form_vopros_send",10000);
					$("#contacts_name").val("");
					$("#contacts_email").val("");
					$("#contacts_text").val("");
				}
			});

		}
	});