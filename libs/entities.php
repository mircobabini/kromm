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