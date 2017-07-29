<?php $category = $attributes[ 'category' ]; ?>
<h3>Category</h3>
<hr>
<div>
	<div class="">
		<div class="">
			<p><?php _e( $category->GetName() ); ?></p>
			<p><?php _e( $category->GetDescription() ); ?></p>
		</div>
	</div>
</div>
<div class="plugin-content-link">
	<a href="?page=dbsnet-category&doaction=create-new">
		<button id="add-category" class="btn btn-primary">
			<span class="glyphicon glyphicon-plus"></span> Add
		</button>
	</a>
	<a href="?page=dbsnet-category&doaction=edit&category=<?php _e( $category->GetID() ) ?>">
		<button id="edit-category" class="btn btn-warning">
			<span class="glyphicon glyphicon-edit"></span> Edit
		</button>
	</a>
	<a href="?page=dbsnet-category&doaction=delete&category=<?php _e( $category->GetID() ) ?>">
		<button id="delete-category" class="btn btn-danger">
			<span class="glyphicon glyphicon-trash"></span> Delete
		</button>
	</a>
	| Go to <a href="<?php echo admin_url( 'admin.php?page=dbsnet-category' ); ?>">category list</a>.
</div>