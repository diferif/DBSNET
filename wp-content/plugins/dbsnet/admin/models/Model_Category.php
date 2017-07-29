<?php

class Model_Category implements IlistItem
{
	private $table_name;

	private $listfor;
	public function iSet_Listfor( $listfor ) { $this->listfor = $listfor; }
	public function iGet_Listfor() { return $this->listfor; }

	private $limit_name;
	public function iSet_LimitName( $limit_name ) { $this->limit_name = $limit_name; }
	public function iGet_LimitName() { return $this->limit_name; }

	private $id;
	public function GetId(){ return $this->id; }

	private $name;
	public function GetName() { return $this->name; }
	public function SetName( $name ) { $this->name = $name; }

	private $description;
	public function GetDescription() { return $this->description; }
	public function SetDescription( $description ) { $this->description = $description; }

	function __construct()
	{
		$this->table_name = "dbs_category";
		$this->iSet_Listfor( 'category' );
		$this->iSet_LimitName( 'category_list_limit' );
	}

	public function AddNew() {
		global $wpdb;

		$result = array( 'status' => false, 'message' => 'Error AddNew()- Category' );

		if( $wpdb->insert(
			$this->table_name,
			array(
				'category_name' => $this->name,
				'category_desc' => $this->description
				),
			array(
				'%s','%s'
				)
			) ){
			$result[ 'status' ] = true;
			$result[ 'message' ] = 'Berhasil menambah Category';
		}
		return $result;
	}

	public function Update() {
		global $wpdb;
		$result = array( "status" => false, "message" => "gagal update category" );

		$arrUpdateData = array(
			'category_name' => $this->name,
			'category_desc' => $this->description
			);
		$arrCondition = array( 'category_id' => $this->id );
		$arrDataType = array( '%s','%s' );
		$arrConditionType = array( '%d' );

		if( $wpdb->update(
			$this->table_name,
			$arrUpdateData,
			$arrCondition,
			$arrDataType,
			$arrConditionType
			) )
		{
			$result[ 'status' ] = true;
			$result[ 'message' ] = "berhasil update category";
		}
		return $result;
	}

	public function Delete(){
		global $wpdb;

		$result = array( "status" => false, "message" => "" );
		if( $wpdb->query(
			$wpdb->prepare(
				"DELETE FROM $this->table_name WHERE category_id = %d",
				$this->id
			)
		))
			{
				$result['status'] = true;
				$result['message'] = "Berhasil menghapus Category";
			} 
		return $result;
	}

	public function CountData( $searchForName = "", $arg1 = null ) {
		global $wpdb;

		$query = "SELECT COUNT(category_id) AS jumlah FROM $this->table_name " .
					"WHERE category_name LIKE %s";
		$bindValues = array();
		$bindValues[] = "%".$searchForName."%";

		$jumlah =
			$wpdb->get_var(
				$wpdb->prepare(
					$query,
					$bindValues
					)
				);

		return is_null( $jumlah )? 0 : $jumlah;
	}

	public function DataList( $limit = -1, $offset = -1, $searchForName = "", $kategori = 0) {
		global $wpdb;
		$query = "SELECT category_id FROM $this->table_name " .
					"WHERE category_name LIKE %s";
		$bindValues = array();
		$bindValues[] = "%".$searchForName."%";

		if( $limit > 0 && $offset >= 0){
			$str_limit = "LIMIT %d, %d";
			$query .= " ". $str_limit;
			$bindValues[] = $offset;
			$bindValues[] = $limit;
		}
		//var_dump($query, $searchForName);
		$rows =
			$wpdb->get_results(
				$wpdb->prepare(
					$query,
					$bindValues
					)
				);
		//var_dump( $rows ); 
		return $rows;
	}

	public function HasID( $category_id = 0){
		global $wpdb;
		$row =
			$wpdb->get_row(
				$wpdb->prepare(
					"SELECT * FROM $this->table_name 
					WHERE category_id = %d",
					$category_id
					),
				ARRAY_A
				);
		$result = ! is_null( $row );
		if ( $result ){
			$this->id = $row[ 'category_id' ];
			$this->name = $row[ 'category_name' ];
			$this->description = $row[ 'category_desc' ];
		}
		return $result;
	}


}