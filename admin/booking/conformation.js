var studio = getUrlVars()["studioid"];
var time = getUrlVars()["timeslotid"];
var myJSONText = "";
var jsontime = convert(time);

var htmlbuild = "";

$(document).ready(
				function() {
					for ( var i = 0; i < jsontime.length; i++) {
						var each = jsontime[i];
						var splitTime = each["id"].split(',');
						var start = "";
						var end = "";

						start = startTime[parseInt(splitTime[0] - 1)];

						if (splitTime[splitTime.length - 1].indexOf("#") != -1) {
							end = endTime[parseInt(splitTime[splitTime.length - 1]
									.substr(0, splitTime[splitTime.length - 1]
											.indexOf("#")) - 1)];
						} else {
							end = endTime[parseInt(splitTime[splitTime.length - 1] - 1)];
						}

						htmlbuild = htmlbuild + dateToYMD(each['date'] - 1)
								+ " : " + start + " - " + end + '<br/>';
					}

					$("#timedate").html(htmlbuild);

					$('input[name="user-exist"]').change(function() {
						$("#user_exist").val($(this).val());
						if ($(this).val() == "yes") {
							$("#user-do").removeAttr("hidden");
							$("#user-dont").attr("hidden", "hidden");
						} else {
							$("#user-dont").removeAttr("hidden");
							$("#user-do").attr("hidden", "hidden");
						}
						$("#err").html("");
					});

					$('input[name="roar-use"]').change(function() {
						$("#roar_use").val($(this).val());
					});
					
					$("#user_timeslotid").val(myJSONText);
				});

function dateToYMD(add) {
	var date = new Date();
	var newDate = new Date(date.getFullYear(), date.getMonth(), date.getDate()
			+ add);
    
    return newDate.toDateString();
}

function back() {
	window.location.href = "booking.php?studioid=" + studio + "&timeslotid="
			+ time;
}

function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(
			window.location.href.indexOf('?') + 1).split('&');
	for ( var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}

function convert(selectedId) {
	var jsonObj = [];

	if (selectedId != "") {
		var splitId = selectedId.split(';');
		var selectedDate = 0;
		var previousId = -1;
		var ids = "";
		for ( var i = 0; i < splitId.length; i++) {
			var a = splitId[i].split('_');

			if (i == splitId.length - 1) {
				if(a[1].indexOf('#') != -1){
					a[1] = a[1].substr(0, a[1].indexOf('#'));
				}
			}

			if (selectedDate == 0) {
				selectedDate = a[0];
				ids = a[1];
				previousId = a[1];
			} else if (selectedDate == a[0]
					&& ((++previousId) == parseInt(a[1]))) {
				ids = ids + "," + a[1];
				previousId = a[1];
			} else {
				jsonObj.push({
					date : selectedDate,
					id : ids
				});
				selectedDate = a[0];
				previousId = parseInt(a[1]);
				ids = a[1];
			}
		}

		jsonObj.push({
			date : selectedDate,
			id : ids
		});
		selectedDate = 0;
		ids = "";
		myJSONText = JSON.stringify(jsonObj);
	}

	return jsonObj;
}

function searchUser() {
	var name = $("#user-name").val();
	$("#roar-info").attr("hidden", "hidden");

	var request_time = $.ajax({
		url : "searchuser.php?name=" + name,
		type : "POST",
		processData : true,
		dataType : "text"
	});

	request_time.done(function(msg) {
		if (msg != "") {
			$("#user-list").html(msg);
			$("#roar-info").removeAttr("hidden");
			$('input[name="user-list"]').change(function() {
				$("#user_list").val($(this).val());
			});
		} else {
			alert("No User Exist");
		}
	});

	request_time.fail(function(jqXHR, textStatus) {
		alert("Request failed: " + textStatus + ". Please try again.");
	});
}

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(
			/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	return pattern.test(emailAddress);
};

function validateForm() {
	var user_exist = document.forms["payment_form"]["user_exist"].value;
	var clicked = document.forms["payment_form"]["submit"].value;
	var booking_err = "";

	if (user_exist == "yes") {
		if ($('input[name="user-list"]').length == 0) {
			booking_err = booking_err
					+ "[User] Plese search and select the user. <br/>";
		} else {
			var user_list = document.forms["payment_form"]["user_list"].value;
			var roar_use = document.forms["payment_form"]["roar_use"].value;

			if (user_list == null || user_list == "")
				booking_err = booking_err
						+ "[User] Please select the user. <br/>";

			if (roar_use == null || roar_use == "")
				booking_err = booking_err
						+ "[Roar Credit] Plese select to use or not the ROAR Credit. <br/>";

			if (roar_use == "yes") {
				var roarCredit = parseInt(user_list.split(',')[1]);
				var totalCharge = parseInt($("#roar_charges").html());

				if (totalCharge > roarCredit)
					booking_err = booking_err
							+ "[Roar Credit] ROAR credit is insufficient. <br/>";

			}
		}

	} else if (user_exist == "no") {
		var user_email = document.forms["payment_form"]["user-email"].value;
		var user_name_nonuser = document.forms["payment_form"]["user-name-nonuser"].value;
		if (user_email == null || user_email == "")
			booking_err = booking_err + "[User Email] Plese insert client email. <br/>";
		else if (!isValidEmailAddress(user_email))
			booking_err = booking_err + "[User Email] Plese insert email in correct format (abc@abc.com). <br/>";
		
		if (user_name_nonuser == null || user_name_nonuser == "")
			booking_err = booking_err + "[User Name] Plese insert User's Name. <br/>";
	} else {
		booking_err = booking_err
				+ "[User Exist] Plese select user exist or not. <br/>";
	}

	if (booking_err != "") {
		$("#err").html(booking_err);
		return false;
	}
}
