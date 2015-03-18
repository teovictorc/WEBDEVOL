<?php
	require_once("easyCRUD.class.php");
/**
 * Session
 */
	class LogAvaliacoes Extends Crud  {

	/**
	 * Db Object
	*/
	private $db;
	public  $session_id;

	# Your Table name
	protected $table = 'log_avaliacoes';

	# Primary Key of the Table
	protected $pk	 = 'id';

	/**
	 * Write
	 */
	public function _writeAccess($usuario_id, $num_rar){
	  // Create time stamp
		$this->created = date("Y-m-d H:i:s");
		$this->usuario_id = $usuario_id;
		$this->num_rar = $num_rar;
		$this->token = session_id();

	  // Attempt Execution
	  // If successful
		if($this->Create()){
	    // Return True
			return true;
		}

	  // Return False
		return false;
	}
	public function informacaoLog($type = 1, $texto){
		if(!empty($type)){
			switch ($type) {
				case 1:
					$texto = "Acesso";
					break;
				case 3:
					$texto = "Finalização";
					break;
				default:
					# code...
					break;
			}
			return $texto;
		}else{
			return NULL;
		}
	}
}