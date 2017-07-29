<?php $tenant = $attributes[ 'tenant' ]; ?>
<h3>Tenant - <?php _e( $tenant->GetName() ); ?></h3>
<hr>
<div>
	<div class="row">
		<!-- <div class="col col-sm-4">
			<h3 class=""><?php //_e( $tenant->GetNama() ); ?></h3>
			<img src="<?php //_e( $tenant->GetGambarUtama()->GetLinkGambar() ); ?>">
		</div> -->
		<div class="col col-sm-8">
			<p><?php _e( $tenant->GetDescription() ); ?></p>
			<p><?php _e( $tenant->GetAddress() ); ?></p>
			<p><?php _e( $tenant->GetTelp() ); ?></p>
			<!-- <p><a href="?page=dbsnet-personal&detail=<?php //_e( $tenant->GetPemilik()->GetID() ); ?>"><?php //_e( $tenant->GetPemilik()->GetNama() ); ?></a></p> -->
		</div>
	</div>
	<div>
		<!-- <ul><h4>Gambar:</h4>
			<?php //foreach( $tenant->GetGambars() as $gbr ): ?>
			<?php //var_dump($gbr); ?>
				<li><img src="<?php //_e( $gbr->GetLinkGambar() ) ?>" width="10%"></li>
			<?php //endforeach; ?>
		</ul> -->
	</div>
	<div>
		<!-- <ul><h4>Product:</h4>
			<?php //foreach( $tenant->GetProducts() as $product ): ?>
			<?php //var_dump($gbr); ?>
				<li><a href="?page=dbsnet-product&detail=<?php //_e( $product->GetID() ); ?>"><img src="<?php //_e( $product->GetGambarUtama()->GetLinkGambar() ) ?>" width="10%"></a></li>
			<?php //endforeach; ?>
		</ul> -->
	</div>
</div>
<div class="plugin-content-link">
	<a href="?page=dbsnet-tenant&doaction=create-new">
		<button id="add-tenant" class="btn btn-primary">
			<span class="glyphicon glyphicon-plus"></span> Add
		</button>
	</a>
	<a href="?page=dbsnet-tenant&doaction=edit&tenant=<?php _e( $tenant->GetID() ) ?>">
		<button id="edit-tenant" class="btn btn-warning">
			<span class="glyphicon glyphicon-edit"></span> Edit
		</button>
	</a>
	<a href="?page=dbsnet-tenant&doaction=delete&tenant=<?php _e( $tenant->GetID() ) ?>">
		<button id="delete-tenant" class="btn btn-danger">
			<span class="glyphicon glyphicon-trash"></span> Delete
		</button>
	</a>
	| Go to <a href="<?php echo admin_url( 'admin.php?page=dbsnet-tenant' ); ?>">Tenant list</a>.
</div>