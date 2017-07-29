<?php 
	$category = $attributes[ 'category' ]; 
?>
<h3>Edit Bank</h3>
<div class="data-wrapper">
	<form class="form-horizontal" id="form-category">
		<?php if( isset( $attributes[ 'message' ] ) ) { ?><div class="form-group"><div class="col-sm-offset-2  col-sm-4 form-message"><p class="text-success"><?php _e( $attributes[ 'message' ] ); ?></p></div></div><?php } ?>
		<div class="form-group">
			<label class="col-sm-offset-2  col-sm-4 control-label form-message" for="message-category"></label>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="category-name">Category Name <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="text" name="category-name" class="form-control" id="category-name" placeholder="category name" required="required" value="<?php _e( $category->GetName() ) ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="category-desc">Category Description <strong>*</strong></label>
			<div class="col-sm-4">
				<input type="text" name="category-desc" class="form-control" id="category-desc" placeholder="category desc" required="required" value="<?php _e( $category->GetDescription() ) ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-4">
				<button class="form-control btn btn-success" type="submit" name="submit-category" id="submit-category"><span class="glyphicon glyphicon-save"></span> Save</button>
			</div>	
		</div>
	</form>
</div>
<div class="plugin-content-link">
	<!-- <button id="add-category" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-category">
		<span class="glyphicon glyphicon-plus"></span> Add
	</button> -->
</div>

<script type="text/javascript">
jQuery(document).ready( function($) {

	$( "#form-category").submit( function(e) {
		e.preventDefault();
		
		var inp_categoryname = $( "#category-name" ),
			inp_categorydesc = $( "#category-desc"),
			not_empty = true;

		if( $.trim( inp_categoryname.val() ) == '' ) {
			inp_categoryname.addClass( 'req-input input-empty');
			inp_categoryname.focus();
			not_empty = false;
		}

		if( $.trim( inp_categorydesc.val() ) == '' ) {
			inp_categorydesc.addClass( 'req-input input-empty');
			inp_categorydesc.focus();
			not_empty = false;
		}

		// console.log(not_empty);

		if( not_empty ) {
			var data = {
				action: "UpdateCategory",
				category: <?php _e( $category->GetId() ) ?>,
				categoryname: inp_categoryname.val(),
				categorydesc: inp_categorydesc.val(),
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
						reset_form_category();
						location.href = "<?php echo admin_url('admin.php?page=dbsnet-category&doaction=edit&category='); ?><?php _e($category->GetID()); ?>&status=success";
					}else{
						$( "div.form-message").html( "<p class='text-danger'>" + result.message + "</p>");
					}
				}
			);
		}else{
			$( "label.form-message").html( "<p class='text-danger'>Category Name is required</p>");
		}
	});

	function reset_form_category() {
		$( "#category-name" ).val( "" );
		$( "#category-desc" ).val( "" );
	}
	
});
</script>