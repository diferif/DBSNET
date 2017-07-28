<?php

/**
* 
*/
class Model_Bank implements IlistItem
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

	function __construct()
	{
		$this->table_name = "dbs_bank";
		$this->iSet_Listfor( 'bank' );
		$this->iSet_LimitName( 'bank_list_limit' );
	}

	public function AddNew() {
		global $wpdb;

		$result = array( 'status' => false, 'message' => 'Error AddNew()- Bank' );

		if( $wpdb->insert(
			$this->table_name,
			array(
				'bank_name' => $this->name
				),
			array(
				'%s'
				)
			) ){
			$result[ 'status' ] = true;
			$result[ 'message' ] = 'Berhasil menambah bank';
		}
		return $result;
	}

	public function Update() {
		global $wpdb;
		$result = array( "status" => false, "message" => "gagal update bank" );

		$arrUpdateData = array(
			'bank_name' => $this->name,
			);
		$arrCondition = array( 'bank_id' => $this->id );
		$arrDataType = array( '%s' );
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
			$result[ 'message' ] = "berhasil update bank";
		}
		return $result;
	}

	public function Delete(){
		global $wpdb;

		$result = array( "status" => false, "message" => "" );
		if( $wpdb->query(
			$wpdb->prepare(
				"DELETE FROM $this->table_name WHERE bank_id = %d",
				$this->id
			)
		))
			{
				$result['status'] = true;
				$result['message'] = "Berhasil menghapus tenant";
			} 
		return $result;
	}

	public function CountData( $searchForName = "", $arg1 = null ) {
		global $wpdb;

		//$query = "SELECT COUNT(id_hotel) AS jumlah FROM $this->table_name";
		$query = "SELECT COUNT(bank_id) AS jumlah FROM $this->table_name " .
					"WHERE bank_name LIKE %s";
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
		$query = "SELECT bank_id FROM $this->table_name " .
					"WHERE bank_name LIKE %s";
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

	public function HasID( $bank_id = 0){
		global $wpdb;
		$row =
			$wpdb->get_row(
				$wpdb->prepare(
					"SELECT * FROM $this->table_name 
					WHERE bank_id = %d",
					$bank_id
					),
				ARRAY_A
				);
		$result = ! is_null( $row );
		if ( $result ){
			$this->id = $row[ 'bank_id' ];
			$this->name = $row[ 'bank_name' ];
		}
		return $result;
	}


}
