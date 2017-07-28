<h3>Create New Tenant</h3>
<div class="data-wrapper">
	<form class="form-horizontal" id="form-tenant">
		<?php if( isset( $attributes[ 'message' ] ) ) { ?><div class="form-group"><div class="col-sm-offset-2  col-sm-4 form-message"><p class="text-success"><?php _e( $attributes[ 'message' ] ); ?></p></div></div><?php } ?>
		<div class="form-group">
			<label class="col-sm-offset-2  col-sm-4 control-label form-message" for="message-tenant"></label>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tenant-username">Username <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="text" name="tenant-username" class="form-control" id="tenant-username" placeholder="username" required="required">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tenant-password">Password <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="password" name="tenant-password" class="form-control" id="tenant-password" placeholder="password" required="required">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tenant-email">Email <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="email" name="tenant-email" class="form-control" id="tenant-email" placeholder="email@email.email" required="required">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tenant-name">Tenant Name <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="text" name="tenant-name" class="form-control" id="tenant-name" placeholder="tenant name" required="required">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-4">
				<button class="form-control btn btn-success" type="submit" name="submit-tenant" id="submit-tenant"><span class="glyphicon glyphicon-save"></span> Save</button>
			</div>	
		</div>
	</form>
</div>
<div class="plugin-content-link">
	<!-- <button id="add-tenant" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-tenant">
		<span class="glyphicon glyphicon-plus"></span> Add
	</button> -->
</div>

<script type="text/javascript">
jQuery(document).ready( function($) {

	$( "#form-tenant").submit( function(e) {
		e.preventDefault();
		
		var inp_username = $( "#tenant-username" ),
			inp_pass = $( "#tenant-password" ),
			inp_email = $( "#tenant-email" ),
			inp_name = $( "#tenant-name" ),
			not_empty = true;

		if( $.trim( inp_username.val() ) == '' ) {
			inp_username.addClass( 'req-input input-empty');
			inp_username.focus();
			not_empty = false;
		}
		if( $.trim( inp_pass.val() ) == '' ) {
			inp_pass.addClass( 'req-input input-empty');
			inp_pass.focus();
			not_empty = false;
		}
		if( $.trim( inp_email.val() ) == '' ) {
			inp_email.addClass( 'req-input input-empty');
			inp_email.focus();
			not_empty = false;
		}
		if( $.trim( inp_name.val() ) == '' ) {
			inp_name.addClass( 'req-input input-empty');
			inp_name.focus();
			not_empty = false;
		}

		// console.log(not_empty);

		if( not_empty ) {
			var data = {
				action: "CreateNewTenant",
				username: inp_username.val(),
				password: inp_pass.val(),
				email: inp_email.val(),
				name: inp_name.val(),
			};
			// console.log(data);
			$.post(
				dbsnet_ajax.ajaxurl,
				data,
				function( response ) {
					var result = jQuery.parseJSON( response );
					console.log(result);
					if( result.status ) {
						$( "div.form-message").html( "<p class='text-success'>Success!</p>");
						reset_form_tenant();
						location.href = "<?php echo admin_url('admin.php?page=dbsnet-tenant&doaction=create-new&status=success'); ?>";
					}else{
						$( "div.form-message").html( "<p class='text-danger'>" + result.message + "</p>");
					}
				}
			);
		}else{
			$( "label.form-message").html( "<p class='text-danger'>Username, Password, Email, and Tenant Name(s) are required.</p>");
		}
	});

	function reset_form_tenant() {
		$( "#tenant-username" ).val( "" );
		$( "#tenant-password" ).val( "" );
		$( "#tenant-email" ).val( "" );
		$( "#tenant-name" ).val( "" );
	}
	
});
</script>