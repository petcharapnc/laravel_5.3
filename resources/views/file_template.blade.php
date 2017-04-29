	<html>
    <head>
    <title></title>
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
	    $(document).ready(function (){$('#example').DataTable();});
	</script>

    </head>
    <body>
	<table class="table" id="table">
	    <thead>
	        <tr>
	            <th class="text-center">#</th>
	            <th class="text-center">First Name</th>
	            <th class="text-center">Last Name</th>
	            <th class="text-center">Email</th>
	            <th class="text-center">Department</th>
	            <th class="text-center">Manager</th>
	            <th class="text-center">Salary ($)</th>
	            <th class="text-center">Actions</th>
	        </tr>
	    </thead>
	    <tbody>
			@foreach($data as $item)
			<tr class="item{{$item->employee_id}}">
	            <td>{{$item->employee_id}}</td>
	            <td>{{$item->first_name}}</td>
	            <td>{{$item->last_name}}</td>
	            <td>{{$item->email}}</td>
	            <td>{{$item->department_id}}</td>
	            <td>{{$item->manager_id}}</td>
				<td>{{$item->salary}}</td>
                <td>
					<button class="edit-modal btn btn-info" data-info="{{$item->employee_id}},{{$item->first_name}},{{$item->last_name}}
					,{{$item->email}},{{$item->department_id}},{{$item->manager_id}},{{$item->salary}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger" data-info="{{$item->employee_id}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>
				</td>
	        </tr>
			@endforeach
	    </tbody>
	</table>
	 
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">แก้ไขข้อมูล</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-lab col-md-3" for="employee_id">รหัสพนักงาน</label>
						<div class="col-md-9">					
							<input type="text" id="employee_id">
						</div>
					</div>
					<div class="form-group">
						<label class="control-lab col-md-3" for="first_name">ชื่อพนักงาน</label>
						<div class="col-md-9">					
							<input type="text" id="first_name">
						</div>
                    	<p class="first_name_error error text-center alert alert-danger hidden"></p>
					</div>	
					<div class="form-group">
						<label class="control-lab col-md-3" for="last_name">นามสกุลพนักงาน</label>
						<div class="col-md-9">					
							<input type="text" id="last_name">
						</div>
                    	<p class="last_name_error error text-center alert alert-danger hidden"></p>
					</div>	
					<div class="form-group">
						<label class="control-lab col-md-3" for="email">อีเมล</label>
						<div class="col-md-9">					
							<input type="text" id="email">
						</div>
                    	<p class="email_error error text-center alert alert-danger hidden"></p>
					</div>
					<div class="form-group">
						<label class="control-lab col-md-3" for="department_id">รหัสแผนก</label>
						<div class="col-md-9">					
							<input type="text" id="department_id">
						</div>
                    	<p class="department_id_error error text-center alert alert-danger hidden"></p>
					</div>	
					<div class="form-group">
						<label class="control-lab col-md-3" for="manager_id">รหัสหัวหน้า</label>
						<div class="col-md-9">					
							<input type="text" id="manager_id">
						</div>
                    	<p class="manager_id_error error text-center alert alert-danger hidden"></p>
					</div>	
					<div class="form-group">
						<label class="control-lab col-md-3" for="salary">เงินเดือน</label>
						<div class="col-md-9">					
							<input type="text" id="salary">
						</div>
                    	<p class="salary_error error text-center alert alert-danger hidden"></p>
					</div>						
				</div>
				<div class="modal-footer">
					<button id="save" type="button" class="btn actionBtn btn-success edit" data-dismiss="modal">
						<span class="glyphicon glyphicon-check"></span> Update
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span> Close
					</button>
				</div>
			</div>

		</div>
	</div>
	{{ csrf_field() }}
	<script>
	  $(document).ready(function() {
	    $('#table').DataTable();
	} );
	
	  $(document).on('click', '.edit-modal',  function(){ 
		  $('#myModal').modal('show'); 
		  var stuff = $(this).data('info').split(',');
		  $('#employee_id').val(stuff[0]);
		  $('#first_name').val(stuff[1]);
		  $('#last_name').val(stuff[2]);
		  $('#email').val(stuff[3]);
		  $('#department_id').val(stuff[4]);
		  $('#manager_id').val(stuff[5]);
		  $('#salary').val(stuff[6]);
		});

	   $(document).on('click','#save', function(){ 
		   $.ajax({
				type: 'post',
				url: '/editItem',
				data: {
					'_token': $('input[name=_token]').val(),
					'employee_id': $("#employee_id").val(),
					'first_name': $('#first_name').val(),
					'last_name': $('#last_name').val(),
					'email': $('#email').val(),
					'department_id': $('#department_id').val(),
					'manager_id': $('#manager_id').val(),
					'salary': $('#salary').val()
				},
				success: function (data){

                    if (data.errors) {
                        $('#myModal').modal('show');
                        // if (data.errors.first_name) {
                        //     $('.first_name_error').text(data.errors.first_name);
                        // }
                    }
					else{
						$('.item' + data.employee_id).replaceWith(
							"<tr class='item" + data.employee_id + "'>"+
								"<td>" + data.employee_id + "</td>"+
								"<td>" + data.first_name + "</td>"+
								"<td>" + data.last_name + "</td>"+
								"<td>" + data.email + "</td>"+
								"<td>" + data.department_id + "</td>"+
								"<td>" + data.manager_id + "</td>"+
								"<td>" + data.salary + "</td>"+
								"<td><button class='edit-modal btn btn-info' data-info='" 
									+ data.employee_id + "," 
									+ data.first_name + "," 
									+ data.last_name + "," 
									+ data.email + "," 
									+ data.department + "," 
									+ data.salary + 
								"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" 
									+ data.employee_id + "," 
									+ data.first_name + "," 
									+ data.last_name + "," 
									+ data.email + "," 
									+ data.gender + "," 
									+ data.country + "," 
									+ data.salary + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");					
					}
				}
			});
	   });
	   $(document).on('click','.delete-modal',function(){
		   var stuff = $(this).data('info');
			$.ajax({
				type: 'post',
				url: '/deleteItem',
				data: {
					'_token': $('input[name=_token]').val(),
					'employee_id': stuff
				},
				success: function (data){
					$('.item' + data.employee_id).replaceWith("");
				}
	   });
	   });
	 </script>

    </body>
    </html>