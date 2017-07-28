<?php 
	$data = $attributes[ 'tenant' ];
	//var_dump($data);
?>
<?php if( sizeof( $data ) > 0 ): ?>
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $data as $ul ): ?>
			<tr>
				<td><?php _e( $ul->GetName() ) ?></td>
				<td><a href="?page=dbsnet-tenant&detail=<?php _e( $ul->GetID() ); ?>">Detail</a> | <a href="?page=dbsnet-tenant&doaction=edit&tenant=<?php _e( $ul->GetID() ); ?>">Edit</a> | <a href="?page=dbsnet-tenant&doaction=delete&tenant=<?php _e( $ul->GetID() ); ?>">Delete</a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php endif; ?>