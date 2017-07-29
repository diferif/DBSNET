<?php 
	$data = $attributes[ 'category' ];
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
				<td><a href="?page=dbsnet-category&detail=<?php _e( $ul->GetID() ); ?>">Detail</a> | <a href="?page=dbsnet-category&doaction=edit&category=<?php _e( $ul->GetID() ); ?>">Edit</a> | <a href="?page=dbsnet-category&doaction=delete&category=<?php _e( $ul->GetID() ); ?>">Delete</a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php endif; ?>