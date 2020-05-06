<html>
<head>
    <title>Insert Update Delete Data using Codeigniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
	<br /><br /><br />
	<h3 align="center">Insert Update Delete Data using Codeigniter</h3><br />
	<form method="post" action="<?php echo base_url()?>main/form_validation">
		<?php
		if($this->uri->segment(2) == "inserted")
		{
		//base url - http://localhost/tutorial/codeigniter
		//redirect url - http://localhost/tutorial/codeigniter/main/inserted
			//main  - segment(1)
			//inserted - segment(2)
			echo '<p class="text-success">Data Inserted</p>';
		}
		if($this->uri->segment(2) == "updated")
		{
			echo '<p class="text-success">Data Updated</p>';
		}
		
		?>


		<?php
		if(isset($user_data))
		{
			foreach($user_data->result() as $row)
			{
		?>
		<div class="form-group">
			<label>Enter First Name</label>
			<input type="text" name="first_name" value="<?php echo $row->first_name; ?>" class="form-control" />
			<span class="text-danger"><?php echo form_error("first_name"); ?></span>
		</div>
		<div class="form-group">
			<label>Enter Last Name</label>
			<input type="text" name="last_name" value="<?php echo $row->last_name; ?>" class="form-control" />
			<span class="text-danger"><?php echo form_error("last_name"); ?></span>
		</div>
		<div class="form-group">
			<input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>" />
			<input type="submit" name="update" value="Update" class="btn btn-info" />
		</div>	
		<?php	
			}
		}
		else
		{
		?>
		
		<div class="form-group">
			<label>Enter First Name</label>
			<input type="text" name="first_name" class="form-control" />
			<span class="text-danger"><?php echo form_error("first_name"); ?></span>
		</div>
		<div class="form-group">
			<label>Enter Last Name</label>
			<input type="text" name="last_name" class="form-control" />
			<span class="text-danger"><?php echo form_error("last_name"); ?></span>
		</div>
		<div class="form-group">
			<input type="submit" name="insert" value="Insert" class="btn btn-info" />
		</div>	
		<?php

		}
		?>
	</form>
	<br /><br />
	<h3>Fetch Data from Table using Codeigniter</h3><br />

	<div class="table-responsive">
		<table class="table table-bordered">
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Delete</th>
				<th>Update</th>
			</tr>
		
		</table>
	</div>
	<script>

	$(document).ready(function(){
		$('.delete_data').click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url(); ?>main/delete_data/"+id;
			}
			else
			{
				return false;
			}
		});
	});


	</script>

</div>
</body>
</html>