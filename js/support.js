$(document).ready(function() {

	
	$("#support-editor").live("click", function(){
		$("#message").fadeOut();
	});

	$('.save-continue-support').live('click', function(event) {
		save_continue_support();
		}// end function(event)
	);// end click
	
	$(".cancel-support-edit").live("click",function(event){
		var action = confirm("Are you sure you want to cancel? Any changes you made will not be saved.");
		if(action){
			var myStudent = $("#kStudent").val();
			document.location = base_url + "index.php/support/list_all/" + myStudent;
		}
	});

	$('.save-close-support').live('click', function(event) {
						document.forms["support-editor"].submit();
					}// end function(event)
			); // end click

	$('#delete-support').live('click', function(event) {
						var action = confirm("Do you really want to delete this? This cannot be undone!");
						var myStudent = $('#kStudent').val();
						var myNeed = $('#kNeed').val();
						var myUrl = base_url + "index.php/support/delete";
						var form_data = {
								kStudent: myStudent,
								kNeed: myNeed
						};
						if (action) {
							var real_action = confirm("Are you absolutely sure? This really cannot be undone!");
							if(real_action) {
								$("#action").val("delete");
								$("#support-editor").attr("action",base_url + "index.php/support/delete");
								$("#support-editor").submit();
							}
							
						}
					}

			);

	
	$('#print-support').live('click',function(event){
		var myStudent=$("#kStudent").val();
		var myNeed=$("#kNeed").val();
		if(myNeed!="") {
			var myUrl = base_url + "index.php/support/view/" + myNeed + "/print";
			window.open(myUrl);
		}
	});
	
	$('.show_support').live('click', function(event) {
		// $data=array("kStudent"=>$kStudent,"kTeach"=>$kTeach,"narrTerm"=>$narrTerm,"narrYear"=>$narrYear,"narrSubject"=>$narrSubject);
		var myStudent = $('#kStudent').val();
		var myTeacher = $('#kTeach').val();
		var myTerm = $('#narrTerm').val();
		var myYear = $('#narrYear').val();
		var mySubject = $('#narrSubject').val();
		var myNeed = this.id.split("_")[1];
		var form_data = {
				kStudent: myStudent,
				kTeacher: myTeacher,
				narrTerm: myTerm,
				narrYear: myYear,
				narrSubject: mySubject,
				kNeed: myNeed,
				ajax: 1
		};
		var myUrl = base_url + "index.php/support/view/" + myNeed + "/sidebar";
		$.ajax({
			type: "POST",
			url: myUrl,
			data: form_data,
			success: function(data){
				showSidebar('Accommodations and Needs',
						data, '95%', '60%', '35%');
			}
		});
		
});// end show_needs.click
	
	
	/*** FILE MANAGEMENT ***/
	$('.show-support-file-uploader').live('click', function(event){
		var myNeed = $("#kNeed").val();
		var myStudent = $("#kStudent").val();

		var myUrl = base_url + "index.php/support/new_file";
		var form_data = {
				kNeed: myNeed,
				kStudent: myStudent,
				ajax: 1
		};
		$.ajax({
			type: 'POST',
			data: form_data,
			url: myUrl,
			success: function(data){
			showPopup("Add a File", data, 'auto');
		}
		});
	});
	
	$(".attach-support-file").live("click", function(event){
		save_continue_support();
		$("#support-file-editor").submit();
		
	});
	
	
	$(".delete-support-file").live("click", function(event){
		var action = confirm("Are you sure you want to delete this file? This cannot be undone!");
		if(action) {
			var new_action = confirm("This really cannot be undone!");
			if(new_action) {
				var myFile = this.id.split("_")[1];
				var myUrl = base_url + "index.php/support/delete_file";
				var form_data = {
						kFile: myFile,
				};
				
				$.ajax({
					type: "POST",
					data: form_data,
					url: myUrl,
					success: function(data){
					$("#fr_" + myFile).fadeOut();
				
				}
				});
			}
		}
	});
	$('.accordion').accordion(
			{
				autoHeight: false, 
				icons: { 'header': 'ui-icon-circle-plus', 'headerSelected': 'ui-icon-circle-minus'},
				collapsible: true,
				ffDefault: 'tahoma,sans-serif'
			}
		);

}// end ready
);// end $(document)


function save_continue_support(){
	var myAction = $('#action').val();
	$("#ajax").val(1);
	var form_data = $('#support-editor').serialize();
	form_data["ajax"] = 1;
	var myUrl = base_url + "index.php/support/" + myAction;
	$.ajax({
		type: "post",
		url: myUrl,
		data: form_data,
		success: function(data){
		if(myAction == "insert") {
			$("#kNeed").val(data);
			$("#action").val("update");
			$("#delete-support").removeClass("hidden");
			$("#print-support").removeClass("hidden");
			$(".insert-message").addClass("hidden");
			$(".show-support-file-uploader").removeClass("hidden");
			$("#support-editor").attr("action",base_url + "index.php/support/update");
			$("#message").html("The support record was successfully added" ).fadeIn();
		}else {
			$("#message").html("The support record was successfully updated " + data).fadeIn();
		}
	}
	
	});//end ajax
	$("#ajax").val(0);

}
