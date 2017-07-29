<?php
class DBSnet_Content_Manager_Admin {
	protected $version;

	public function __construct( $version ) {
		$this->version = $version;
	}

	public function enqueue_scripts_and_styles() {
		wp_enqueue_style(
			'dbsnet-content-manager-admin',
			plugin_dir_url( __FILE__ ) . 'css/dbsnet-content-manager-admin.css',
			array(),
			$this->version,
			FALSE
			);

		wp_register_script( 'dbsnet-script', plugin_dir_url( __FILE__ ) . 'js/dbsnet-script.js' );
		wp_enqueue_script( 'dbsnet-script' );

		wp_localize_script( 'dbsnet-script', 'dbsnet_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
	}


	public function create_dbsnet_menu_admin() {
		add_menu_page(
			'DBSnetContent',
			'DBSnet',
			'manage_options',
			'dbsnet-content-dashboard',
			array( $this, 'render_dbsnet_dasboard'),
			plugins_url ( 'images/dbsnet-logo.png', __FILE__), '0.1.0'
			);

		add_submenu_page(
			'dbsnet-content-dashboard',
			'DBSnet' . ' Tenant',
			'Tenant',
			'manage_options',
			'dbsnet-tenant',
			array( $this, 'render_dbsnet_tenant')
			);

		add_submenu_page(
			'dbsnet-content-dashboard',
			'DBSnet' . ' Outlet',
			'Outlet',
			'manage_options',
			'dbsnet-outlet',
			''//array( $this, 'render_dbsnet_service')
			);

		add_submenu_page(
			'dbsnet-content-dashboard',
			'DBSnet' . ' Product',
			'Product',
			'manage_options',
			'dbsnet-product',
			array( $this, 'render_dbsnet_product')
			);
		add_submenu_page(
			'dbsnet-content-dashboard',
			'DBSnet' . 'Product Category',
			'Product Category',
			'manage_options',
			'dbsnet-category',
			array( $this, 'render_dbsnet_category')
			);

		add_submenu_page(
			'dbsnet-content-dashboard',
			'DBSnet' . ' Customer',
			'Customer',
			'manage_options',
			'dbsnet-customer',
			''//array( $this, 'render_dbsnet_service')
			);
		add_submenu_page(
			'dbsnet-content-dashboard',
			'DBSnet' . ' Bank',
			'Bank',
			'manage_options',
			'dbsnet-bank',
			array( $this, 'render_dbsnet_bank')
			);


		// add_submenu_page(
		// 	'dbsnet-content-dashboard',
		// 	'DBSnet' . ' Clients',
		// 	'<b style="color:#ffA500">CLIENTS</b>',
		// 	'manage_options',
		// 	'dbsnet-clients',
		// 	array( $this, 'render_dbsnet_client')
		// 	);
	}

	public function render_dbsnet_dasboard(){
		$content = $this->get_html_template( 'pages', 'main', null, TRUE);
		$this->get_html_template( 'pages', 'template', $content );
	}

	public function render_dbsnet_tenant(){
		if( isset( $_GET[ 'detail' ] ) && $_GET[ 'detail' ] > 0 ) {
			$get_detail = sanitize_text_field( $_GET[ 'detail'] );
			$obj = new Model_Tenant();

			$content = $this->loadDetail( $obj, $get_detail, "tenant", "tenant");
		}
		else if( isset( $_GET[ 'doaction' ] ) && $_GET[ 'doaction' ] != "" ){
			$get_action = sanitize_text_field( $_GET[ 'doaction' ] );
			
			$attributes = array();

			// $attributes[ 'person' ] = $this->get_array_datalist( 'person' );

			$action_template = "";
			if( $get_action == "create-new" ){
				$action_template = "add";

				if( isset( $_GET[ 'status' ] )) {
					$get_status = sanitize_text_field( $_GET[ 'status' ] );
					if( $get_status == 'success' ) {
						$attributes[ 'message' ] = "Success Bro!";
					}
				}
			}
			else {
				if ( isset( $_GET[ 'tenant' ] ) && ($_GET[ 'tenant' ] > 0) ) {
					$get_tenant_id = sanitize_text_field( $_GET[ 'tenant' ] );

					if( $get_action == "edit" ) {

						$action_template = "edit";

						if( isset( $_GET[ 'status' ] )) {
							$get_status = sanitize_text_field( $_GET[ 'status' ] );
							if( $get_status == 'success' ) {
								$attributes[ 'message' ] = "Success Bro!";
							}
						}
					}
					else if( $get_action == 'delete' ) {

						$action_template = 'delete';
					}

					$obj = new Model_Tenant();
					$obj->HasID( $get_tenant_id );
					$attributes[ 'tenant' ] = $obj;
				}
			}

			$content = $this->get_html_template( 'pages/tenant', $action_template, $attributes, TRUE );
		}
		else {
			// $obj = new Sltg_UKM();
			$content = $this->get_html_template( 'pages/tenant', 'main', null, TRUE);
		}

		$this->get_html_template( 'pages', 'template', $content );
	}

	public function render_dbsnet_bank(){
		if( isset( $_GET[ 'detail' ] ) && $_GET[ 'detail' ] > 0 ) {
			// $get_detail = sanitize_text_field( $_GET[ 'detail'] );
			// $obj = new Sltg_UKM();

			// $content = $this->loadDetail( $obj, $get_detail, "tenant", "tenant");
		}
		else if( isset( $_GET[ 'doaction' ] ) && $_GET[ 'doaction' ] != "" ){
			$get_action = sanitize_text_field( $_GET[ 'doaction' ] );
			
			$attributes = array();

			// $attributes[ 'person' ] = $this->get_array_datalist( 'person' );

			$action_template = "";
			if( $get_action == "create-new" ){
				$action_template = "add";

				if( isset( $_GET[ 'status' ] )) {
					$get_status = sanitize_text_field( $_GET[ 'status' ] );
					if( $get_status == 'success' ) {
						$attributes[ 'message' ] = "Success Bro!";
					}
				}
			}
			else {
				if ( isset( $_GET[ 'bank' ] ) && ($_GET[ 'bank' ] > 0) ) {
					$get_bank_id = sanitize_text_field( $_GET[ 'bank' ] );

					if( $get_action == "edit" ) {

						$action_template = "edit";

						if( isset( $_GET[ 'status' ] )) {
							$get_status = sanitize_text_field( $_GET[ 'status' ] );
							if( $get_status == 'success' ) {
								$attributes[ 'message' ] = "Success Bro!";
							}
						}
					}
					else if( $get_action == 'delete' ) {

						$action_template = 'delete';
					}

					$obj = new Model_Bank();
					$obj->HasID( $get_bank_id );
					$attributes[ 'bank' ] = $obj;
				}
			}

			$content = $this->get_html_template( 'pages/bank', $action_template, $attributes, TRUE );
		}
		else {
			$content = $this->get_html_template( 'pages/bank', 'main', null, TRUE);
		}

		$this->get_html_template( 'pages', 'template', $content );
	}

	public function render_dbsnet_product(){
		if( isset( $_GET[ 'detail' ] ) && $_GET[ 'detail' ] > 0 ) {
			// $get_detail = sanitize_text_field( $_GET[ 'detail'] );
			// $obj = new Sltg_UKM();

			// $content = $this->loadDetail( $obj, $get_detail, "tenant", "tenant");
		}
		else if( isset( $_GET[ 'doaction' ] ) && $_GET[ 'doaction' ] != "" ){
			$get_action = sanitize_text_field( $_GET[ 'doaction' ] );
			
			$attributes = array();

			// $attributes[ 'person' ] = $this->get_array_datalist( 'person' );

			$action_template = "";
			if( $get_action == "create-new" ){
				$action_template = "add";

				if( isset( $_GET[ 'status' ] )) {
					$get_status = sanitize_text_field( $_GET[ 'status' ] );
					if( $get_status == 'success' ) {
						$attributes[ 'message' ] = "Success Bro!";
					}
				}
			}
			else {
				if ( isset( $_GET[ 'product' ] ) && ($_GET[ 'product' ] > 0) ) {
					$get_bank_id = sanitize_text_field( $_GET[ 'product' ] );

					if( $get_action == "edit" ) {

						$action_template = "edit";

						if( isset( $_GET[ 'status' ] )) {
							$get_status = sanitize_text_field( $_GET[ 'status' ] );
							if( $get_status == 'success' ) {
								$attributes[ 'message' ] = "Success Bro!";
							}
						}
					}
					else if( $get_action == 'delete' ) {

						$action_template = 'delete';
					}

					$obj = new Model_Product();
					$obj->HasID( $get_bank_id );
					$attributes[ 'product' ] = $obj;
				}
			}

			$content = $this->get_html_template( 'pages/product', $action_template, $attributes, TRUE );
		}
		else {
			$content = $this->get_html_template( 'pages/product', 'main', null, TRUE);
		}

		$this->get_html_template( 'pages', 'template', $content );
	}

	public function render_dbsnet_category(){
		if( isset( $_GET[ 'detail' ] ) && $_GET[ 'detail' ] > 0 ) {
			$get_detail = sanitize_text_field( $_GET[ 'detail'] );
			$obj = new Model_Category();

			$content = $this->loadDetail( $obj, $get_detail, "category", "category");
		}
		else if( isset( $_GET[ 'doaction' ] ) && $_GET[ 'doaction' ] != "" ){
			$get_action = sanitize_text_field( $_GET[ 'doaction' ] );
			
			$attributes = array();

			// $attributes[ 'person' ] = $this->get_array_datalist( 'person' );

			$action_template = "";
			if( $get_action == "create-new" ){
				$action_template = "add";

				if( isset( $_GET[ 'status' ] )) {
					$get_status = sanitize_text_field( $_GET[ 'status' ] );
					if( $get_status == 'success' ) {
						$attributes[ 'message' ] = "Success Bro!";
					}
				}
			}
			else {
				if ( isset( $_GET[ 'category' ] ) && ($_GET[ 'category' ] > 0) ) {
					$get_bank_id = sanitize_text_field( $_GET[ 'category' ] );

					if( $get_action == "edit" ) {

						$action_template = "edit";

						if( isset( $_GET[ 'status' ] )) {
							$get_status = sanitize_text_field( $_GET[ 'status' ] );
							if( $get_status == 'success' ) {
								$attributes[ 'message' ] = "Success Bro!";
							}
						}
					}
					else if( $get_action == 'delete' ) {

						$action_template = 'delete';
					}

					$obj = new Model_Category();
					$obj->HasID( $get_bank_id );
					$attributes[ 'category' ] = $obj;
				}
			}

			$content = $this->get_html_template( 'pages/category', $action_template, $attributes, TRUE );
		}
		else {
			$content = $this->get_html_template( 'pages/category', 'main', null, TRUE);
		}

		$this->get_html_template( 'pages', 'template', $content );
	}

	private function get_html_template( $location, $template_name, $attributes = null , $return_val = FALSE) {
		if (! $attributes ) {
			$attributes = array();
		}
		ob_start();
		require( $location . '/' . $template_name . '.php' );
		$html = ob_get_contents();
		ob_end_clean();
		if ( $return_val )
			return $html;
		echo $html;
	}

	private function loadDetail( $obj, $id_detail, $att_key, $dir) {

		$obj->HasID( $id_detail );
		$attributes[ "$att_key" ] = $obj;

		$content = $this->get_html_template( 'pages/' . $dir, "detail" , $attributes, TRUE);
		return $content;
	}

	public function CreateTenant() {
		$result = array( 'status' => false, 'message' => '' );
		//echo wp_json_encode( $_POST );
		$post_isset = isset( $_POST[ 'name' ] ) && isset( $_POST[ 'username' ] ) && isset( $_POST[ 'email' ] ) && isset( $_POST[ 'password' ] ) ;
		// echo wp_json_encode( $post_isset );
		if( $post_isset ) {
			$post_name = sanitize_text_field( $_POST[ 'name' ] );
			$post_email = sanitize_text_field( $_POST[ 'email' ] );
			$post_password = sanitize_text_field( $_POST[ 'password' ] );
			// $post_username = sanitize_text_field( $_POST[ 'username' ] );

			$post_not_empty = ($post_name!="") && ($post_email!="") && ($post_password!="") && ($post_username!="");
			// echo wp_json_encode( $post_not_empty );
			if( $post_not_empty ) {
				$tenant = new Model_Tenant();
				$tenant->SetName( $post_name );
				$tenant->SetEmail( $post_email );
				$tenant->SetPassword( $post_password );
				$tenant->SetUsername( $post_username );
				// echo wp_json_encode( $tenant->GetUsername);
				$result = $tenant->AddNew();
			}
			else {
				$result[ 'message' ] = 'parameter tidak valid!';
			}
		}
		else {
			$result[ 'message' ] = 'parameter tidak lengkap!';
		}

		echo wp_json_encode( $result );

		wp_die();
	}

	public function CreateBank() {
		$result = array( 'status' => false, 'message' => '' );
		//echo wp_json_encode( $_POST );
		$post_isset = isset( $_POST[ 'bankname' ] );
		// echo wp_json_encode( $post_isset );
		if( $post_isset ) {
			$post_bankname = sanitize_text_field( $_POST[ 'bankname' ] );
			
			$post_not_empty = ($post_bankname!="");
			// echo wp_json_encode( $post_not_empty );
			if( $post_not_empty ) {
				$bank = new Model_Bank();
				$bank->SetName( $post_bankname );
				
				// echo wp_json_encode( $tenant->GetUsername);
				$result = $bank->AddNew();
			}
			else {
				$result[ 'message' ] = 'parameter tidak valid!';
			}
		}
		else {
			$result[ 'message' ] = 'parameter tidak lengkap!';
		}

		echo wp_json_encode( $result );

		wp_die();
	}

	public function CreateCategory() {
		$result = array( 'status' => false, 'message' => '' );
		//echo wp_json_encode( $_POST );
		$post_isset = isset( $_POST[ 'categoryname' ] ) && isset( $_POST[ 'categorydesc' ] );
		// echo wp_json_encode( $post_isset );
		if( $post_isset ) {
			$post_categoryname = sanitize_text_field( $_POST[ 'categoryname' ] );
			$post_categorydesc = sanitize_text_field( $_POST[ 'categorydesc' ] );
			
			$post_not_empty = ($post_categoryname!="") && ($post_categorydesc!="");
			// echo wp_json_encode( $post_not_empty );
			if( $post_not_empty ) {
				$category = new Model_Category();
				$category->SetName( $post_categoryname );
				$category->SetDescription( $post_categorydesc );

				// echo wp_json_encode( $tenant->GetUsername);
				$result = $category->AddNew();
			}
			else {
				$result[ 'message' ] = 'parameter tidak valid!';
			}
		}
		else {
			$result[ 'message' ] = 'parameter tidak lengkap!';
		}

		echo wp_json_encode( $result );

		wp_die();
	}

	// private function get_array_datalist( $listof ) {
	// 	$attributes = array();

	// 	if( $listof == 'service' ) {
	// 		$obj = new DBSnet_Service_Model();
	// 		$dtlist = $obj->Datalist();
	// 		foreach( $dtlist as $dl ) {
	// 			$data = new DBSnet_Service_Model();
	// 			$data->HasID( $dl->service_id );
	// 			$attributes[] = $data;
	// 		}
	// 	}

	// 	return $attributes;
	// }

	public function UpdateTenant() {
		$result = array( 'status' => false, 'message' => '' );
		$post_isset = isset( $_POST[ 'tenant' ] ) && isset( $_POST[ 'name' ] ) && isset( $_POST[ 'email' ] );
		
		// var_dump($_POST);
		if( $post_isset ) {
			$post_tenant = sanitize_text_field( $_POST[ 'tenant' ] );
			$post_name = sanitize_text_field( $_POST[ 'name' ] );
			$post_email = sanitize_text_field( $_POST[ 'email' ] );

			$post_not_empty = ($post_tenant>0) && ($post_name!="") && ($post_email!="");
			// var_dump($post_not_empty);
			if( $post_not_empty ) {
				
				$tenant = new Model_Tenant();
				$tenant->HasID( $post_tenant );

				// compare data
				$oldData = array(
					$tenant->GetEmail(), // deskripsi
					$tenant->GetName() // other
					);
				$newData = array(
					$post_email, // email
					$post_name // nama 
					);
				// var_dump($newData);
				// var_dump($oldData);
				// $result = $this->update_pictures( $ukm, /*'ukm',*/ $post_gambararr );

				if ( $oldData !== $newData ) {
					$tenant->SetEmail( $post_email );
					$tenant->SetName( $post_name );

					$result = $tenant->Update();
				}
			}
			else {
				$result[ 'message' ] = 'parameter tidak valid!';
			}
		}
		else {
			$result[ 'message' ] = 'parameter tidak lengkap!';
		}

		echo wp_json_encode( $result );

		wp_die();
	}

	public function UpdateBank() {
		$result = array( 'status' => false, 'message' => '' );
		$post_isset = isset( $_POST[ 'bank' ] ) && isset( $_POST[ 'name' ] );
		
		// var_dump($_POST);
		if( $post_isset ) {
			$post_bank = sanitize_text_field( $_POST[ 'bank' ] );
			$post_name = sanitize_text_field( $_POST[ 'name' ] );

			$post_not_empty = ($post_bank>0) && ($post_name!="");
			// var_dump($post_not_empty);
			if( $post_not_empty ) {
				
				$bank = new Model_Bank();
				$bank->HasID( $post_bank );

				// compare data
				$oldData = array(
					$bank->GetName() // other
					);
				$newData = array(
					$post_name // nama 
					);
				
				if ( $oldData !== $newData ) {
					$bank->SetName( $post_name );

					$result = $bank->Update();
				}
			}
			else {
				$result[ 'message' ] = 'parameter tidak valid!';
			}
		}
		else {
			$result[ 'message' ] = 'parameter tidak lengkap!';
		}

		echo wp_json_encode( $result );

		wp_die();
	}

	public function UpdateCategory() {
		$result = array( 'status' => false, 'message' => '' );
		$post_isset = isset( $_POST[ 'category' ] ) && isset( $_POST[ 'categoryname' ] ) && isset( $_POST[ 'categorydesc' ] );
		
		//var_dump($_POST);
		if( $post_isset ) {
			$post_category = sanitize_text_field( $_POST[ 'category' ] );
			$post_categoryname = sanitize_text_field( $_POST[ 'categoryname' ] );
			$post_categorydesc = sanitize_text_field( $_POST[ 'categorydesc' ] );

			$post_not_empty = ($post_category > 0) && ($post_categoryname!="") && ($post_categorydesc!="");
			// var_dump($post_not_empty);
			if( $post_not_empty ) {
				
				$category = new Model_Category();
				$category->HasID( $post_category );

				// compare data
				$oldData = array(
					$category->GetName(),
					$category->GetDescription()// other
					);
				$newData = array(
					$post_categoryname,
					$post_categorydesc// nama 
					);
				
				if ( $oldData !== $newData ) {
					$category->SetName( $post_categoryname );
					$category->SetDescription( $post_categorydesc );

					$result = $category->Update();
				}
			}
			else {
				$result[ 'message' ] = 'parameter tidak valid!';
			}
		}
		else {
			$result[ 'message' ] = 'parameter tidak lengkap!';
		}

		echo wp_json_encode( $result );

		wp_die();
	}

	public function RetrievePagination() {

		if( isset( $_GET[ 'listfor' ] ) && isset( $_GET[ 'limit' ] ) ) {

			$get_listfor = sanitize_text_field( $_GET[ 'listfor' ] );
			$get_limit = sanitize_text_field( $_GET[ 'limit' ] );
			$get_search = "";
			$get_kategori = 0;
			$get_genre = 0;
			$filter = 0;

			if( isset( $_GET[ 'category' ] ) ) {
				$get_kategori = sanitize_text_field( $_GET[ 'category' ] );
				$filter = $get_kategori;
			}
			if( isset( $_GET[ 'search' ] ) ) {
				$get_search = sanitize_text_field( $_GET[ 'search' ] );
			}

			$obj = null;
			$option_limit_name = "";
			if( $get_listfor == 'tenant' ){
				$obj = new Model_Tenant();
			}

			if( $get_listfor == 'bank' ){
				$obj = new Model_Bank();
			}

			if( $get_listfor == 'category' ){
				$obj = new Model_Category();
			}


			$attributes[ 'listfor' ] = $obj->iGet_Listfor();
			$option_limit_name = $obj->iGet_LimitName();

			update_option( $option_limit_name, $get_limit );

			$attributes[ 'n-page' ] = $this->create_pagination( $obj, $get_limit, $get_search, $filter );

			echo $this->get_html_template( 'pages', 'pagination' , $attributes, FALSE );

		}
		wp_die();
	}

	private function create_pagination( $obj, $limit, $search = "", $kategori = 0 ) {

		$jumlah_data = $obj->CountData( $search, $kategori );

		$jumlah_page = intval( $jumlah_data / $limit );
		if( $jumlah_data % $limit > 0 ) $jumlah_page += 1;

		return $jumlah_page;
	}

	public function RetrieveList(){
		
		if( isset( $_GET[ 'listfor' ] ) && isset( $_GET[ 'page' ] ) && isset( $_GET[ 'limit' ] ) ) {
			
			$n_get = count( $_GET );
			$get_listfor = sanitize_text_field( $_GET[ 'listfor' ] );
			$get_limit = sanitize_text_field( $_GET[ 'limit' ] );
			$get_page = sanitize_text_field( $_GET[ 'page' ] );
			$get_search = "";
			$get_kategori = 0;
			$get_genre = 0;
			$filter = 0;

			if( isset( $_GET[ 'category' ] ) ) {
				$get_kategori = sanitize_text_field( $_GET[ 'category' ] );
				$filter = $get_kategori;
			}
			if( isset( $_GET[ 'search' ] ) ) {
				$get_search = sanitize_text_field( $_GET[ 'search' ] );
			}

			$offset = ( $get_page - 1 ) * $get_limit;
			$obj = null;

			if( $get_listfor == 'tenant' ) {
				$obj = new Model_Tenant();
				$dir_obj = "tenant";
			}

			if( $get_listfor == 'bank' ) {
				$obj = new Model_Bank();
				$dir_obj = "bank";
			}

			if( $get_listfor == 'category' ) {
				$obj = new Model_Category();
				$dir_obj = "category";
			}

			$rows = $obj->DataList( $get_limit, $offset, $get_search, $filter );

			$arrObj = array();

			foreach( $rows as $row ){
				if( $get_listfor == 'tenant' ){
					$tenant = new Model_Tenant();
					$tenant->HasID( $row->ID );
					$arrObj['tenant'][] = $tenant;
				}

				if( $get_listfor == 'bank' ){
					$bank = new Model_Bank();
					$bank->HasID( $row->bank_id );
					$arrObj['bank'][] = $bank;
				}

				if( $get_listfor == 'category' ){
					$category = new Model_Category();
					$category->HasID( $row->category_id );
					$arrObj['category'][] = $category;
				}
			}
			// var_dump($arrObj['service']);
			$this->get_html_template( 'pages/' . $dir_obj, 'list', $arrObj , false);
		}
		wp_die();
	}

	// public function create_service() {
	// 	$result = array( 'status' => false, 'message' => '' );
	// 	$post_isset = isset( $_POST[ 'name' ] ) && isset( $_POST[ 'description' ] );

	// 	if( $post_isset ) {
	// 		$post_name = sanitize_text_field( $_POST[ 'name' ] );
	// 		$post_description = sanitize_text_field( $_POST[ 'description' ] );

	// 		$post_not_empty = ($post_name!="") && ($post_description!="");

	// 		if( $post_not_empty ) {
	// 			$service = new DBSnet_Service_Model();
	// 			$service->SetName( $post_name );
	// 			$service->SetDescription( $post_description );

	// 			$result = $service->AddData();
	// 		}
	// 		else {
	// 			$result[ 'message' ] = 'parameter tidak valid!';
	// 		}
	// 	}
	// 	else {
	// 		$result[ 'message' ] = 'parameter tidak lengkap!';
	// 	}

	// 	echo wp_json_encode( $result );

	// 	wp_die();
	// }
	// public function update_service() {
	// 	$result = array( 'status' => false, 'message' => '' );
	// 	$post_isset = isset( $_POST[ 'service' ] ) && isset( $_POST[ 'name' ] ) && isset( $_POST[ 'description' ] ) ;
		
	// 	if( $post_isset ) {
	// 		$post_service_id = sanitize_text_field( $_POST[ 'service' ] );
	// 		$post_name = sanitize_text_field( $_POST[ 'name' ] );
	// 		$post_description = sanitize_text_field( $_POST[ 'description' ] );

	// 		$post_not_empty = ($post_service_id>0) && ($post_name!="") && ($post_description!="");

	// 		if( $post_not_empty ) {
				
	// 			$service = new DBSnet_Service_Model();
	// 			$service->HasID( $post_service_id );

	// 			// compare data
	// 			$oldData = array(
	// 				$service->GetName(), // name 
	// 				$service->GetDescription(), // description
	// 				);
	// 			$newData = array(
	// 				$post_name, // name 
	// 				$post_description, // description
	// 				);

	// 			if ( $oldData !== $newData ) {
	// 				$service->SetName( $post_name );
	// 				$service->SetDescription( $post_description );
	// 				$result = $service->UpdateData();
	// 			}
	// 		}
	// 		else {
	// 			$result[ 'message' ] = 'parameter tidak valid!';
	// 		}
	// 	}
	// 	else {
	// 		$result[ 'message' ] = 'parameter tidak lengkap!';
	// 	}

	// 	echo wp_json_encode( $result );

	// 	wp_die();
	// }

}