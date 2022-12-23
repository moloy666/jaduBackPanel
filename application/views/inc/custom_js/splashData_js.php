<script type="text/javascript">
	var baseUrl = '<?=apiBaseUrl?>';
	var default_splash_image = '<?=base_url('assets/images/splash_default.png')?>';
	$(document).ready(function(){
		
	});

	$('#sarathi').click(function(){
		splash_for = 'sarathi';
		$('#splash_for').val(splash_for);
		display_splash_data(splash_for);
	});

	$('#driver').click(function(){
		splash_for = 'driver';
		$('#splash_for').val(splash_for);
		display_splash_data(splash_for);
	});

	$('#customer').click(function(){
		splash_for = 'customer';
		$('#splash_for').val(splash_for);
		display_splash_data(splash_for);
	});


	function editSplash(id, heading, body, splashFor, image){

		if(splashFor == "_____"){
			splashFor = "";
		}
		$("#edit_output").attr("src", baseUrl + image);
		$('#edit_id').val(id);
		$('#edit_heading').val(heading);
		$('#edit_body').val(body);
		$('#edit_for').val(splashFor);		

		// $('#add_image').val(image);		

	}


	function display_splash_data(splash_for){		
		$.ajax({
			type:"POST",
			url:`<?=base_url('administrator/splash_data')?>`,
			data:{
				'for':splash_for
			},
			error:function(response){
				console.log(response);
			},
			success:function(response){
				if(response.success){
					// console.log(response);
					var splash = response.data;
					var data='';
					$.each(splash, function(i){

						if(splash[i].for==null || splash[i].for==''){
							splash[i].for = "_____";
						}

						data +=`<tr>
						<td class="text-center"><image class="splash_image" src="${baseUrl}${splash[i].image}"></td>
						<td>${splash[i].heading}</td>
						<td>${splash[i].body}</td>						
						<td class="text-center">${splash[i].for}</td>						
						<td>
						<div class="d-flex align-items-center">
							<div class="mx-1">
								<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edtSplh" data-toggle="tooltip" data-placement="bottom" title="Edit" 
								onclick="editSplash('${splash[i].id}' , '${splash[i].heading}' , '${splash[i].body}' , '${splash[i].for}' , '${splash[i].image}')">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
							</div>

							<div class="mx-1">
								<button class='btn btn-sm btn-danger' onclick="delete_splash(this, '${splash[i].id}')" data-toggle="tooltip" data-placement="bottom" title="Delete">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</button>
							</div>
						</div>
						</td>
						</tr>
						`;						
					});
					
					if(splash_for=='sarathi'){
						$('#sarathiSplash').html(data);
                        $('.ibox-title').text('Sarathi Splash Data');
					}
					if(splash_for=='driver'){
						$('#driverSplash').html(data);
                        $('.ibox-title').text('Driver Splash Data');
					}
					if(splash_for=="customer"){
						$('#customerSplash').html(data);
                        $('.ibox-title').text('Customer Splash Data');
					}

				}
				else{
					// console.log(response);
				}
			}
		});
	}

	function delete_splash(element, splash_id){
		// console.log(splash_id);

		$.ajax({
			type:"POST",
			url:"<?=base_url('administrator/delete_splash_data')?>",
			data:{
				"id":splash_id
			},
			error:function(response){
				console.log(response);
			},
			success:function(response){
				if(response.success){
					display_splash_data(splash_for);
					toast(response.message, "center");
				}
				else{
					toast(response.message, "center");
					// console.log(response);
				}
			},
		});
	}


	$('#update_form').submit(function(e){
		e.preventDefault();
		let form = document.getElementById("update_form");
        let formData = new FormData(form);

		// url:"https://jaduridedev.v-xplore.com/service/editSplashData",
		
		$.ajax({
			type:"POST",
			url:"<?=apiBaseUrl?>service/editSplashData",
			headers: {
				'x-api-key': '<?=const_x_api_key?>',
				'platform': 'web',
				'deviceid': ''
			},
			data:formData,
			contentType: false,
            processData: false,
			error:function(response){
				console.log(response);
			},
			success:function(response){
				if(response.status){
					display_splash_data(splash_for);
					$('#edtSplh').modal('hide'); 
					toast(response.message, "center");
					$('#update_form')[0].reset();

				}
				else{
					// console.log(response);
					toast(response.message, "center");

				}
			}
		});
	});

	$('#add_form').submit(function(e){
		e.preventDefault();
		let form = document.getElementById("add_form");
        let formData = new FormData(form);

		$.ajax({
			type:"POST",
			// url:"https://jaduridedev.v-xplore.com/service/addSplashData",
			url:"<?=apiBaseUrl?>service/addSplashData",
			headers: {
				'x-api-key': '<?=const_x_api_key?>',
				'platform': 'web',
				'deviceid': ''
			},
			data:formData,
			contentType: false,
            processData: false,
			error:function(response){
				console.log(response);
			},
			success:function(response){
				// console.log(response);
				if(response.status){
					display_splash_data(splash_for);
					$('#addSplh').modal('hide'); 
					
					toast(response.message, 'center');
					$('#add_form')[0].reset();

					$("#output").attr("src", default_splash_image);

				}
				else{
					
					toast(response.message, 'center');
				}
			}
		});
	});

	var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);

    };

	var editLoadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('edit_output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);

    };




</script>

<style>
	.splash_image{		
		width:120px;
		height:auto;
	}
</style>