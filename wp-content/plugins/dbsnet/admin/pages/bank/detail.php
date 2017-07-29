<?php $bank = $attributes[ 'bank' ]; ?>
<h3>Bank</h3>
<hr>
<div>
	<div class="">
		<div class="">
			<p><?php _e( $bank->GetName() ); ?></p>
			<!-- <p><?phpb// _e( $bank->GetDescription() ); ?></p> -->
		</div>
	</div>
</div>
<div class="plugin-content-link">
	<a href="?page=dbsnet-bank&doaction=create-new">
		<button id="add-bank" class="btn btn-primary">
			<span class="glyphicon glyphicon-plus"></span> Add
		</button>
	</a>
	<a href="?page=dbsnet-bank&doaction=edit&bank=<?php _e( $bank->GetID() ) ?>">
		<button id="edit-bank" class="btn btn-warning">
			<span class="glyphicon glyphicon-edit"></span> Edit
		</button>
	</a>
	<a href="?page=dbsnet-bank&doaction=delete&bank=<?php _e( $bank->GetID() ) ?>">
		<button id="delete-bank" class="btn btn-danger">
			<span class="glyphicon glyphicon-trash"></span> Delete
		</button>
	</a>
	| Go to <a href="<?php echo admin_url( 'admin.php?page=dbsnet-bank' ); ?>">bank list</a>.
</div>