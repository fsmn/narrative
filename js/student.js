$(document).ready(function() {

	$("#stuEmail").live('blur', function(event) {
		var myEmail = this.value;
		var myStudent = $("#kStudent").val();
		var myUrl = base_url + "student/valid_email/";
		var form_data = {
				stuEmail:myEmail,
				kStudent: myStudent,
				validation: 1
		};
		
		$.ajax({
			url: myUrl,
			type:'POST',
			data: form_data,
			success: function(data){
				$('#valid-email').html(data);
			}
			
		}); //end ajax

	}// end function(event)
	);// end kPO.blur();
	
	$("#generate-email").live("click", function(event){
		var myStudent = $("#kStudent").val();
		var myFirst = $("#stuFirst").val();
		var my_url = base_url + "student/generate_email";
		var form_data = {
				kStudent: myStudent,
				first: myFirst,
				ajax: 1
		};
		$.ajax({
			url: my_url,
			type: 'POST',
			data: form_data,
			success: function(data){
				$("#stuEmail").val(data);
			}
		});
	});
	
			$('#stuSearch').live('keyup', function(event) {
				var stuSearch = this.value;
				if (stuSearch.length > 2 && stuSearch != "find students") {
					searchWords = stuSearch.split(' ');
					myName = searchWords.join('%') + "%";
					var myUrl = base_url + "index.php/student/find_by_name";
					var formData = {
						ajax: 1,
						stuName: stuSearch
					};
					$.ajax({
						url: myUrl,
						type: 'GET',
						data: formData,
						success: function(data){
							$("#searchList").css({"z-index": 1000}).html(data).position({
								my: "left top",
								at: "left bottom",
								of: $("#stuSearch"), 
								collision: "fit"
							}).show();
					}
					});
				}else{
					$("#searchList").hide();
		        	$("#searchList").css({"left": 0, "top": 0});


				}
			});// end stuSearch.keyup
			

			$('#stuSearch').live('focus', function(event) {
				$('#stuSearch').val('').css( {
					color : 'black'
				});
			});
			
			
			$('#stuSearch').live('blur', function(event) {
				
				$("#searchList").fadeOut("slow");
				$('#stuSearch').css({color:'#666'}).val('find students');
				
				
			});

				$('.view_student').live('click',
								function(event) {
									var kStudent = this.id.split("_")[1];
									document.location = base_url + "index.php/student/view/"
											+ kStudent;
								}// end function
						);// end click

				$('.add_student').live('click', function(event) {
					var formData = {
							ajax: '1'
					};
					var myUrl = base_url + "index.php/student/create/";
					$.ajax({
						url: myUrl,
						type: 'POST',
						data: formData,
						success: function(data) {
							showPopup('New Student', data, 'auto');
						}
						
					});
				}	
				);// end add_student.click

				$('.edit_student').live('click', function(event) {
					if (this.id) {
						var myStudent = this.id.split("_")[1];
					} else {
						var myStudent = $("#kStudent").val();
					}
					var formData = {
							kStudent: myStudent,
							ajax: 1
					};
					var myUrl = base_url + "index.php/student/edit/";
					$.ajax({
						url: myUrl,
						type: 'POST',
						data: formData,
						success: function(data){
						showPopup('Edit Student', data, 'auto');
					}
					});
					
					}// end function(event);
				);// end home.click

				$('.save_student').live('click', function(event) {
					saveStudent('save');
				}// end function(event)
				);// end click

				$('.cancel_student')
						.live(
								'click',
								function(event) {
									var kStudent = $("#kStudent").val();
									if (kStudent != '') {
										document.location = "index.php?target=student&action_task=view&kStudent="
												+ kStudent;
									} else {
										document.location = document.location;
									}
								}// end function(event)
						); // end click

				$('.delete_student').live('click', function(event) {
					kStudent = $('#kStudent').val();
					deleteStudent(kStudent);
				}// end function(event);
				);// end home.click


			

				$("#baseYear").live('blur', function(event) {
					var baseYear = parseInt(this.value);
					var yearEnd = baseYear + 1;
					$("#baseYearEnd").val(yearEnd);
					getStuGrade();
				});// end keyUp

				$("#baseGrade").live('blur', function(event) {
					getStuGrade();
				}// end function(event)
				);// end keyup
				
				$("#studentEditor").validate();
		$("#advanced_search").live('click', function(){
			studentSearch();
		});
}// end ready
);// end $(document)



function getStuGrade() {
	myGrade = $('#baseGrade').val();
	if (myGrade == "K") {
		myGrade = 0;
	}
	myGrade = parseInt(myGrade);
	myYear = $("#baseYear").val();
	myYear = parseInt(myYear);
	var today = new Date();
	var currentYear = parseInt(today.getFullYear());
	var currentMonth = parseInt(today.getMonth());
	if (currentMonth < 8) {
		currentYear = currentYear - 1;
	}
	var gradeDiff = currentYear - myYear;
	$('#gradeText').html(myGrade + gradeDiff + ")");
	$('#stuGrade').val(myGrade + gradeDiff);
}

function saveStudent(action) {
	// $('#action_task').val(action);
	var myLocation = document.URL;
	$('#studentEditor').ajaxSubmit(function() {
		document.location = myLocation;
	});
	// document.forms['studentEditor'].submit();
}

function deleteStudent(myStudent) {
	action = confirm("You sure you want to delete this student? This cannot be undone!");
	if (action) {
		$.post('ajax.switch.php', {
			target : 'student',
			action_task : 'delete',
			kStudent : myStudent
		}, function(data) {
			// $('#sidebar').html("the data" + data).fadeIn();

				document.location = "index.php";
			}// end function
		);// end post
	}
}



/*
 * @function studentSearchdescription:  only works with STUDENT_SEARCH_INC I don't
 * know why this isn't just embedded in that document @dependencies
 * STUDENT_SEARCH_INC
 * 
 */
function studentSearch() {
	myYear = parseInt($('#year').val());
	thisYear = new Date();
	thisYear = parseInt(thisYear.getFullYear());
	myLength = myYear.length;
	// myYear=parseInt(myObject.value);
	yearDiff = thisYear - myYear;
	if (myYear == "NaN") {
		alert(myYear + " is decidedly not a number!");
		$('#year').focus();
	} else if (yearDiff > 10) {
		yearDiff = thisYear - myYear;
		alert("This system does not have information on students " + yearDiff
				+ " years ago");
		$('#year').focus();
	} else if (yearDiff < 0) {
		yearDiff = myYear - thisYear;
		alert("Looking to the future, huh? You won't find much useful information "
				+ yearDiff + " years into the future.");
		$('#year').focus();
		document.forms[0].submit();
	} else {
		document.forms[0].submit();
	}
}