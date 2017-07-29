<?php 
	$category = $attributes[ 'category' ];

	if( isset( $_POST[ 'submit-delete-category' ] ) ) {
		$result = $category->Delete();
		$message = "ERROR";
		if( $result[ 'status' ] )
			_e( $result[ 'message' ] );
	}
	else {

?>
<div class="form-delete-area">
	<form id="form-delete-category" method="post">
		<label>Delete <?php _e( $category->GetName() ) ?> from Bank?</label>
		<input type="hidden" value="<?php _e( $category->GetId() ); ?>" name="id-category" id="id-category">
		<button class="btn btn-danger" type="submit" id="btn-delete-category" name="submit-delete-category">YES</button>
	</form>
</div>
| Go to <a href="<?php echo admin_url( 'admin.php?page=dbsnet-category' ); ?>">Bank list</a>.
<?php } ?>