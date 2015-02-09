<?php
class Entity{
	public static $tablename;
	public $ID = null;

	public function __construct( $data ){
		foreach( $data as $key => $value ){
			$this->$key = $value;
		}
	}

	public function tablename(){
		return static::$tablename;
	}

	public function update( $attrs ){
		foreach( $attrs as $attr => $value ){
			$this->$attr = $value;
		}

		global $database;
		$database->update( $this->tablename(), $attrs, ['ID' => $this->ID] );

		return $this;
	}
}
class Entities extends Singleton{
	public function __call( $name, $args ){
		array_unshift( $this->tablename(), $args );

		global $database;
		call_user_func_array([$database, $name], $args);
	}
	public function tablename(){
		return static::$tablename;
	}
	public function entityname(){
		return static::$entityname;
	}
	public function entity( $ID, $attrs ){
		$entityname = $this->entityname();
		$entity = new $entityname( $attrs );
		$entity->ID = $ID;
		return $entity;
	}

	public function insert( $attrs ){
		global $database;
		$ID = $database->insert( $this->tablename(), $attrs );

		return $this->entity( $ID, $attrs );
	}
	public function select( $where = null ){
		global $database;
		$rows = $database->select( $this->tablename(), '*', $where );

		$entities = array();
		foreach( $rows as $row ){
			$ID = $row['ID'];
			unset( $row['ID'] );

			$entities[ $ID ] = $this->entity( $ID, $attrs );
		}

		return $entities;
	}
}
class Singleton{
	public static function instance(){
		static $instance;
		if( $instance === null ){
			$instance = new static;
		}

		return $instance;
	}
	public function classname(){
		return get_called_class();
	}
}