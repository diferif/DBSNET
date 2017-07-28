<?php 
	$bank = $attributes[ 'bank' ];

	if( isset( $_POST[ 'submit-delete-bank' ] ) ) {
		$result = $bank->Delete();
		$message = "ERROR";
		if( $result[ 'status' ] )
			_e( $result[ 'message' ] );
	}
	else {

?>
<div class="form-delete-area">
	<form id="form-delete-bank" method="post">
		<label>Delete <?php _e( $bank->GetName() ) ?> from Bank?</label>
		<input type="hidden" value="<?php _e( $bank->GetId() ); ?>" name="id-bank" id="id-bank">
		<button class="btn btn-danger" type="submit" id="btn-delete-bank" name="submit-delete-bank">YES</button>
	</form>
</div>
| Go to <a href="<?php echo admin_url( 'admin.php?page=dbsnet-bank' ); ?>">Bank list</a>.
<?php } ?>