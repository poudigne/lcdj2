<meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>

<!-- Bootstrap Stylesheet -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- moment -->
<script src="/JS/moment.min.js" crossorigin="anonymous"></script>
<!-- bootstrap transition and collapse -->
<script src="/JS/transition.js"></script>
<script src="/JS/collapse.js"></script>

<link rel="stylesheet" href="/CSS/bootstrap.css">
<link rel="stylesheet" href="/CSS/bootstrap-theme.css">

<!-- Custom Stylesheet -->
<link rel="stylesheet" href="/CSS/Navbar.css">
<link rel="stylesheet" href="/CSS/Footer.css">
<link rel="stylesheet" href="/CSS/Events.css">
<link rel="stylesheet" href="/CSS/Jumbotron.css">

<!-- Bootstrap Javascript -->
<script src="/JS/bootstrap.js" type="text/javascript"></script>

<!-- bootstrap Multiselect -->
<link rel="stylesheet" href="/CSS/bootstrap-multiselect.min.css">
<script src="/JS/bootstrap-multiselect.js" type="text/javascript"></script>

<!-- Bootstrap slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.0.16/bootstrap-slider.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.0.9/css/bootstrap-slider.min.css">

<!-- Bootbox -->
<script src="/JS/bootbox.min.js" type="text/javascript"></script>

<!-- toastr -->
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" crossorigin="anonymous">
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" crossorigin="anonymous"></script>

<!-- bootstrap datetime picker -->
<script src="/JS/bs-datetimepicker.js"></script>
<link rel="stylesheet" href="/CSS/bootstrap-datetimepicker.css">


<style>
.flavor-text {
	margin-left: 10px;
}

.float-right {
	float:right !important;
}
.float-left {
	float:left !important;
	margin: 0 5px 0 0;
}

.btn-delete-image {
	position: 	absolute;
	top: 		10px;
	right: 		25px;
	visibility:	hidden;
}
.borderless td, .borderless th {
	border: none !important;
}
</style>

<script type="text/javascript">
	toastr.options = {
		"closeButton": 			false,
		"debug": 				false,
		"newestOnTop": 			true,
		"progressBar": 			false,
		"positionClass": 		"toast-top-center",
		"preventDuplicates": 	false,
		"onclick": 				null,
		"showDuration": 		"300",
		"hideDuration": 		"1000",
		"timeOut": 				"5000",
		"extendedTimeOut": 		"1000",
		"showEasing": 			"swing",
		"hideEasing": 			"linear",
		"showMethod": 			"fadeIn",
		"hideMethod": 			"fadeOut"
	}

	$(document).ready(function(){
		var bulk_action_json = [];
		$("#check-all").click(function(){
			var is_checked = $(this).prop('checked');
			$(".check-box").each(function(){
				$(this).prop('checked', is_checked);
				$(this).trigger("change");
			});
		});
		$(".check-box").change(function() {
			var product_id = $(this).attr("data-field-id");
			if (this.checked){
				bulk_action_json.push(product_id)
			}
			else{
				for(var i = 0, j = bulk_action_json.length; i < j; ++i) {
					if (bulk_action_json[i] == product_id){
						bulk_action_json.splice(i, 1);
						break;
					}
				}
			}
		});

		$("#delete-request").click(function(){
			if (bulk_action_json.length == 0)
				return;
			var link = $(this).attr("data-field-link");
			bootbox.confirm("Are you sure you want to delete "+ bulk_action_json.length +" elements?", function(result) {
				if (result) {
					sendAjaxRequest(bulk_action_json, link);
				}
			});
		});

		$("#publish-request").click(function(){
			if (bulk_action_json.length == 0)
				return;
			var link = $(this).attr("data-field-link");
			bootbox.confirm("Are you sure you want to publish "+ bulk_action_json.length +" elements?", function(result) {
				if (result) {
					sendAjaxRequest(bulk_action_json, link,[{'value' : 1}]);
				}
			});
		});

		$("#unpublish-request").click(function(){
			if (bulk_action_json.length == 0)
				return;
			var link = $(this).attr("data-field-link");
			bootbox.confirm("Are you sure you want to unpublish "+ bulk_action_json.length +" elements?", function(result) {
				if (result) {
					sendAjaxRequest(bulk_action_json, link,[{'value' : 0}]);
				}
			});
		});


		$(".btn-edit").click(function(){
			var link = $(this).attr('href');
			window.location.href = link;
		});
	});
	var sendAjaxRequest = function(data, link){
		$.ajax({
			url: link,
			type: "post",
			data: {
				"ids"  : data,
				"_token" : "{{ csrf_token() }}"
			},
			dataType: "json"
		}).done(function(response){
			toastr["success"]("The "+response.model_type+" has been successfuly "+response.action_type+"!","Success !");
		}).fail(function(response){
			toastr["error"]("{{ session('error') }}","Error !");
		}).always(function(response) {
			if (response.action_type == 'delete')
				deleteRowNode(response.ids);
			else
				dopublish(response.ids, response.action_type == 'Publish' ? 1 :0);

			bulk_action_json = [];
		});
	}
	var deleteRowNode = function(ids){
		for(var i = 0, j = ids.length; i < j; ++i) {
			var product_id = ids[i];
			var el = $("input[data-field-id='" + product_id + "']");
			el.parent().parent().remove();
		}
	}
	var dopublish = function(ids, action){
		for(var i = 0, j = ids.length; i < j; ++i) {
			var product_id = ids[i];
			var el = $("input[data-field-id='" + product_id + "']");
			if (action == 0)
				el.parent().parent().addClass("warning");
			else
				el.parent().parent().removeClass("warning");
		}
	}


</script>