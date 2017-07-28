<h3>Create New Bank</h3>

<div class="data-wrapper">
	<form class="form-horizontal" id="form-bank">
		<?php if( isset( $attributes[ 'message' ] ) ) { ?><div class="form-group"><div class="col-sm-offset-2  col-sm-4 form-message"><p class="text-success"><?php _e( $attributes[ 'message' ] ); ?></p></div></div><?php } ?>
		<div class="form-group">
			<label class="col-sm-offset-2  col-sm-4 control-label form-message" for="message-bank"></label>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="bank-name">Bank Name <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="text" name="bank-name" class="form-control" id="bank-name" placeholder="name" required="required">
			</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-4">
				<button class="form-control btn btn-success" type="submit" name="submit-bank" id="submit-bank"><span class="glyphicon glyphicon-save"></span> Save</button>
			</div>	
		</div>
	</form>
</div>
<div class="plugin-content-link">

<script type="text/javascript">
jQuery(document).ready( function($) {

	$( "#form-bank").submit( function(e) {
		e.preventDefault();
		
		var inp_bankname = $( "#bank-name" ),
			not_empty = true;

		if( $.trim( inp_bankname.val() ) == '' ) {
			inp_bankname.addClass( 'req-input input-empty');
			inp_bankname.focus();
			not_empty = false;
		}
		
		// console.log(not_empty);

		if( not_empty ) {
			var data = {
				action: "CreateNewBank",
				bankname: inp_bankname.val(),
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
						location.href = "<?php echo admin_url('admin.php?page=dbsnet-bank&doaction=create-new&status=success'); ?>";
					}else{
						$( "div.form-message").html( "<p class='text-danger'>" + result.message + "</p>");
					}
				}
			);
		}else{
			$( "label.form-message").html( "<p class='text-danger'>Bank name is required.</p>");
		}
	});

	function reset_form_tenant() {
		$( "#bank-name" ).val( "" );	}
	
});
</script>