<?php
class Entity{
	public static $tablename;
	public $ID = null;

	public function __construct( $ID, $data ){
		foreach( $data as $key => $value ){
			$this->$key = $value;
		}

		$this->ID = $ID;
	}

	public function tablename(){
		return static::$tablename;
	}

	public function update( $attrs ){
		foreach( $attrs as $attr => $value ){
			$this->$attr = $value;
		}

		database()->update( $this->tablename(), $attrs, ['ID' => $this->ID] );

		return $this;
	}
}
class Entities extends Singleton{
	public function __call( $name, $args ){
		array_unshift( $this->tablename(), $args );

		call_user_func_array([database(), $name], $args);
	}
	public function tablename(){
		return strtolower( $this->classname() );
	}
	public function entityname(){
		return static::$entityname;
	}
	public function entity( $ID, $attrs ){
		$entityname = $this->entityname();
		$entity = new $entityname( $ID, $attrs );
		return $entity;
	}

	public function insert( $attrs ){
		$ID = database()->insert( $this->tablename(), $attrs );

		return $this->entity( $ID, $attrs );
	}
	public function select( $where = null ){
		$rows = database()->select( $this->tablename(), '*', $where );

		$entities = array();
		foreach( $rows as $row ){
			$ID = $row['ID'];
			unset( $row['ID'] );

			$entities[ $ID ] = $this->entity( $ID, $attrs );
		}

		return $entities;
	}
	public function get( $id ){
		$entities = $this->select([ 'id' => $id ]);
		return empty( $entities ) ? null : reset( $entities );
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

// function ENTITIES(){ return ENTITIES::instance(); }
function e( $entitiesname ){
	static $initentities;
	if( ! isset( $initentities[$entitiesname] ) ){
		$entitiespath = DIR_OBJS.'/'.$entitiesname.'/init.php';
		if( ! file_exists( $entitiespath ) ){
			throw new Exception( 'no entity: '.$entitiesname );
		}

		require_once $entitiespath;
		// ENTITY::$tablename = ENTITIES()->tablename();
		$entitiesname::$entityname = $entitiesname::instance()->tablename();
		$initentities[$entitiesname] = $entitiesname::instance();
	}

	return $entitiesname::instance();
}