<?php 
	$bank = $attributes[ 'bank' ]; 
?>
<h3>Edit Bank</h3>
<div class="data-wrapper">
	<form class="form-horizontal" id="form-bank">
		<?php if( isset( $attributes[ 'message' ] ) ) { ?><div class="form-group"><div class="col-sm-offset-2  col-sm-4 form-message"><p class="text-success"><?php _e( $attributes[ 'message' ] ); ?></p></div></div><?php } ?>
		<div class="form-group">
			<label class="col-sm-offset-2  col-sm-4 control-label form-message" for="message-bank"></label>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="bank-name">Bank Name <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="text" name="bank-name" class="form-control" id="bank-name" placeholder="bank name" required="required" value="<?php _e( $bank->GetName() ) ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-4">
				<button class="form-control btn btn-success" type="submit" name="submit-bank" id="submit-bank"><span class="glyphicon glyphicon-save"></span> Save</button>
			</div>	
		</div>
	</form>
</div>
<div class="plugin-content-link">
	<!-- <button id="add-bank" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-bank">
		<span class="glyphicon glyphicon-plus"></span> Add
	</button> -->
</div>

<script type="text/javascript">
jQuery(document).ready( function($) {

	$( "#form-bank").submit( function(e) {
		e.preventDefault();
		
		var inp_name = $( "#bank-name" ),
			not_empty = true;

		if( $.trim( inp_name.val() ) == '' ) {
			inp_name.addClass( 'req-input input-empty');
			inp_name.focus();
			not_empty = false;
		}

		// console.log(not_empty);

		if( not_empty ) {
			var data = {
				action: "UpdateBank",
				bank: <?php _e( $bank->GetId() ) ?>,
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
						//reset_form_ukm();
						location.href = "<?php echo admin_url('admin.php?page=dbsnet-bank&doaction=edit&bank='); ?><?php _e($bank->GetID()); ?>&status=success";
					}else{
						$( "div.form-message").html( "<p class='text-danger'>" + result.message + "</p>");
					}
				}
			);
		}else{
			$( "label.form-message").html( "<p class='text-danger'>Username, Email, and Tenant Name(s) are required.</p>");
		}
	});

	function reset_form_bank() {
		$( "#bank-name" ).val( "" );
	}
	
});
</script>