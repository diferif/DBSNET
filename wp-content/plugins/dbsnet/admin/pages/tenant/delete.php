<?php 
	$tenant = $attributes[ 'tenant' ];

	if( isset( $_POST[ 'submit-delete-tenant' ] ) ) {
		$result = $tenant->Delete();
		$message = "ERROR";
		if( $result[ 'status' ] )
			_e( $result[ 'message' ] );
	}
	else {

?>
<div class="form-delete-area">
	<form id="form-delete-tenant" method="post">
		<label>Delete <?php _e( $tenant->GetName() ) ?> from Tenant?</label>
		<input type="hidden" value="<?php _e( $tenant->GetId() ); ?>" name="id-tenant" id="id-tenant">
		<button class="btn btn-danger" type="submit" id="btn-delete-tenant" name="submit-delete-tenant">YES</button>
	</form>
</div>
| Go to <a href="<?php echo admin_url( 'admin.php?page=dbsnet-tenant' ); ?>">Tenant list</a>.
<?php } ?>