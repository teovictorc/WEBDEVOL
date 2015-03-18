<?php
require('Db.class.php');
/**
 * Session
 */
	class LogAvaliacoes {

	  /**
	   * Db Object
	   */
	  private $db;
	  public  $session_id;

	  public function __construct(){
	  // Instantiate new Database object
	  	$this->db = new DB;

	  // Set handler to overide SESSION
	  	session_set_save_handler(
	  		array($this, "_open"),
	  		array($this, "_close"),
	  		array($this, "_read"),
	  		array($this, "_write"),
	  		array($this, "_destroy"),
	  		array($this, "_gc")
	  		);
	  // Start the session
	  	session_start();

	  	$this->session_id = session_id ();
	  }

	/**
	 * Open
	 */
	public function _open(){
	  // If successful
		if($this->db){
	    // Return True
			return true;
		}
	  // Return False
		return false;
	}

	/**
	 * Close
	 */
	public function _close(){
	  // Close the database connection
	  // If successful
		if($this->db->close()){
	    // Return True
			return true;
		}
	  // Return False
		return false;
	}

	/**
	 * Read
	 */
	public function _read($id){
	  // Set query
		$this->db->query('SELECT log.* FROM log_avaliacoes log WHERE id = :id');

	  // Bind the Id
		$this->db->bind(':id', $id);

	  // Attempt execution
	  // If successful
		if($this->db->execute()){
	    // Save returned row
			$row = $this->db->single();
	    // Return the data
			return $row;
		}else{
	    // Return an empty string
			return '';
		}
	}

	/**
	 * Write
	 */
	public function _writeAccess($usuario_id){
	  // Create time stamp
		$created = date("Y-m-d H:i:s");

	  // Set query
		$this->db->query('INSERT INTO log_avaliacoes (usuario_id, token, created) VALUES (:usuario_id, :token, :created)');

	  // Bind data
		$this->db->bind(':usuario_id', $usuario_id);
		$this->db->bind(':token', $this->session_id);
		$this->db->bind(':created', $created);

	  // Attempt Execution
	  // If successful
		if($this->db->execute()){
	    // Return True
			return true;
		}

	  // Return False
		return false;
	}

	/**
	 * Destroy
	 */
	public function _destroy($id){
	  // Set query
		$this->db->query('DELETE FROM sessions WHERE id = :id');

	  // Bind data
		$this->db->bind(':id', $id);

	  // Attempt execution
	  // If successful
		if($this->db->execute()){
	    // Return True
			return true;
		}

	  // Return False
		return false;
	}

	/**
	 * Garbage Collection
	 */
	public function _gc($max){
	  // Calculate what is to be deemed old
		$old = time() - $max;

	  // Set query
		$this->db->query('DELETE * FROM sessions WHERE access < :old');

	  // Bind data
		$this->db->bind(':old', $old);

	  // Attempt execution
		if($this->db->execute()){
	    // Return True
			return true;
		}

	  // Return False
		return false;
	}
}