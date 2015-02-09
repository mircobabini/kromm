<?php
function controller( $ctr_name ){
	return require dirname(__FILE__)."/ctrs/{$ctr_name}.php";
}
