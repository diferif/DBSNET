<?php

class Model_Tenant implements IListItem {

	private $table_name;

	private $listfor;
	public function iSet_Listfor( $listfor ) { $this->listfor = $listfor; }
	public function iGet_Listfor() { return $this->listfor; }

	private $limit_name;
	public function iSet_LimitName( $limit_name ) { $this->limit_name = $limit_name; }
	public function iGet_LimitName() { return $this->limit_name; }

	private $id;
	public function GetId(){ return $this->id; }

	private $pict_code;
	public function GetPictCode() { return $this->pict_code; }
	public function SetPictCode( $pict_code ) { $this->pict_code = $pict_code; }

	private $username;
	public function GetUsername() { return $this->username; }
	public function SetUsername( $username ) { $this->username = $username; }

	private $password;
	// public function GetPassword() { return $this->password; }
	public function SetPassword( $password ) { $this->password = $password; }

	private $email;
	public function GetEmail() { return $this->email; }
	public function SetEmail( $email ) { $this->email = $email; }

	private $name;
	public function GetName() { return $this->name; }
	public function SetName( $name ) { $this->name = $name; }
	
	private $description;
	public function GetDescription() { return $this->description; }
	public function SetDescription($description) { $this->description = $description; }

	private $address;
	public function GetAddress() { return $this->address; }
	public function SetAddress( $address ) { $this->address = $address; }

	private $telp;
	public function GetTelp() { return $this->telp; }
	public function SetTelp($telp) { $this->telp = $telp; }

	// private $other;
	// public function GetOther() { return $this->other; }
	// public function SetOther($other) { $this->other = $other; }

	// IN RELATIONSHIP

	// private $pemilik;
	// public function GetPemilik() { 
	// 	$obj_person = new Sltg_Personal();
	// 	$obj_person->HasID( $this->pemilik );
	// 	return $obj_person; 
	// }
	// public function SetPemilik($pemilik) { $this->pemilik = $pemilik; }
	
	//private $gambar_utama;
	// public function GetGambarUtama() { 
	// 	$obj_gbr = new Sltg_Gambar();

	// 	$obj_gbr->UtamaByOwner( $this->pict_code );
	// 	//var_dump($obj_gbr->UtamaByOwner( $this->pict_code )->GetLinkGambar());
	// 	return $obj_gbr; 
	// }
	// public function SetGambarUtama( $gambar_utama ) { $this->gambar_utama = $gambar_utama; }

	//private $gambars;
	// public function GetGambars() { 
	// 	$arrGambar = array();
	// 	$obj_gbr = new Sltg_Gambar();

	// 	$list_gambar = $obj_gbr->ListByOwner( $this->pict_code );
	// 	foreach( $list_gambar as $g) {
	// 		$gambar = new Sltg_Gambar();
	// 		$gambar->HasID( $g->id_gambar );

	// 		$arrGambar[] = $gambar;
	// 	}

	// 	return $arrGambar; 
	// }

	// private $products;
	// public function GetProducts() { 
	// 	$obj_product = new Sltg_Product();
	// 	$list_product = $obj_product->ListByOwner( $this->id );
	// 	foreach( $list_product as $p ) {
	// 		$product = new Sltg_Product();
	// 		$product->HasID( $p->id_produk );
	// 		$this->products[] = $product;
	// 	}
	// 	return $this->products; 
	// }
	// public function SetProducts( $products ) { $this->products = $products; }


	function __construct() {
		$this->table_name = "dbs_tenant";

		$this->iSet_Listfor( 'tenant' );
		$this->iSet_LimitName( 'tenant_list_limit' );
		// $this->products = array();
	}

	public function HasID( $user_id = 0){
		global $wpdb;
		$row = get_userdata( $user_id );
		$result = ! is_null( $row );
		if ( $result ){
			// var_dump($row);
			$this->id = $row->ID;
			$this->getAdditional($this->id);
			$this->name = $row->first_name;
			$this->username = $row->user_login;
			$this->email = $row->user_email;
			// $this->password = $row->user_pass;
			// $this->telp = $row[0]->telp_ukm;
			$this->description = $row->description;
		}
		return $result;
	}

	private function getAdditional( $user_id ){
		global $wpdb;
		$row =
			$wpdb->get_row(
				$wpdb->prepare(
					"SELECT * FROM $this->table_name 
					WHERE user_id = %d",
					$user_id
					),
				ARRAY_A
				);
		$result = ! is_null( $row );
		if ( $result ){
			$this->address = $row[ 'tenant_address' ];
			$this->telp = $row[ 'tenant_telp' ];
		}
	}

	public function CountData( $searchForName = "", $arg1 = null ) {
		global $wpdb;

		$tenant_user = get_users(
			array(
				'search' => $searchForName,
				'role'	=> 'editor'
				)
			);

		$jumlah = count($tenant_user);

		return ( $jumlah > 0 )? $jumlah : 0;
	}

	public function DataList( $limit = -1, $offset = -1, $searchForName = "", $kategori = 0) {
		global $wpdb;
		$filterdata = array(
				'search' => $searchForName,
				'role'	=> 'editor'
			);

		if( $limit > 0 && $offset >= 0){
			$filterdata['number'] = $limit;
			$filterdata['offset'] = $offset;
		}
		//var_dump($query, $searchForName);
		$rows = get_users($filterdata);
		//var_dump( $rows ); 
		return $rows;
	}

	public function AddNew() {
		global $wpdb;

		$result = array( 'status' => false, 'message' => 'Error AddNew()-Tenant' );

		// ADD TO WP_USER TBL
		$userdata = array(
	        'user_login'    =>   $this->username,
	        'user_email'    =>   $this->email,
	        'user_pass'     =>   $this->password,
	        'user_url'      =>   "",
	        'first_name'    =>   $this->name,
	        'last_name'     =>   "",
	        'nickname'      =>   "",
	        'description'   =>   ""
        );
        $user = wp_insert_user( $userdata );
        
        if(! is_wp_error( $user )){
	        wp_update_user( array ('ID' => $user, 'role' => 'editor') ) ;
	        // ADD TO DBS_TENANT TBL

			if( $wpdb->insert(
				$this->table_name,
				array(
					'user_id' => $user,
					'tenant_telp' => "",
					),
				array(
					'%d', '%s'
					)
				) ){
				$result[ 'status' ] = true;
				$result[ 'message' ] = 'Berhasil menambah tenant baru';
			}
		}else{
			$result[ 'message' ] = 'Gagal menambah tenant baru, username mungkin sama';
		}
		return $result;
	}

	public function Delete(){ // & DELETE OUTLET & PRODUCT & REVIEW & MAIL
		global $wpdb;

		$result = array( "status" => false, "message" => "" );

		require_once(ABSPATH.'wp-admin/includes/user.php');

		if( wp_delete_user( $this->id ) ){
			if( $wpdb->query(
				$wpdb->prepare(
					"DELETE FROM $this->table_name WHERE user_id = %d",
					$this->id
				)
			)) {
				$result['status'] = true;
				$result['message'] = "Berhasil menghapus tenant";
			}
			
		}			

		return $result;

	}

	// public function deleteGambars() {
	// 	$arrGambar = $this->GetGambars();
	// 	//global $wpdb;
	// 	$result = ( sizeof( $arrGambar ) == 0 );

	// 	if( sizeof( $arrGambar ) > 0 ) {
	// 		$obj_gbr = new Sltg_Gambar();
	// 		$obj_gbr->SetOwner( $this->pict_code );

	// 		$result = $obj_gbr->DeleteMultiple();

	// 		foreach( $arrGambar as $gbr ) {
	// 			$result = $result && $gbr->DeletePost();
	// 		}
			
	// 	}
	// 	return $result;
	// }

	// private function deleteProducts() {
	// 	$arrProducts = $this->GetProducts();
	// 	//global $wpdb;
	// 	$result[ 'status' ] = ( sizeof( $arrProducts ) == 0 );

	// 	if( sizeof( $arrProducts ) > 0 ) {
	// 		foreach( $arrProducts as $product ) {
	// 			// $product = new Sltg_Product();
	// 			// $product->HasID( $p->id_produk );
	// 			$result[ 'status' ] = $product->Delete();
	// 		}
	// 	}

	// 	return $result[ 'status' ];
	// }

	public function Update() {
		global $wpdb;
		$result = array( "status" => false, "message" => "gagal update ukm" );

		$arrUpdateData = array(
			'ID'		=>	$this->id,
			// 'user_login' => $this->username,
			'user_email' => $this->email,
			'first_name' => $this->name
			);

		$user_id = wp_update_user($arrUpdateData);

		if(! is_wp_error( $user_id )) {
			$result[ 'status' ] = true;
			$result[ 'message' ] = "berhasil update tenant";
		}
		return $result;
	}

	// public function ListByOwner( $owner ) {
	// 	global $wpdb;

	// 	$rows =
	// 		$wpdb->get_results(
	// 			$wpdb->prepare(
	// 				"SELECT * FROM $this->table_name ".
	// 				"WHERE owner = %d",
	// 				$owner
	// 				)
	// 			);//var_dump($rows);
	// 	return $rows;
	// }
}