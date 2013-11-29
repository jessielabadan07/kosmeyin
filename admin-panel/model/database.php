<?php
# require other fields

# Database configuration
require_once('include/db.config.php');

# a parent class Database
class Database {
	
	# protected fields 
	protected $connect = 1;			# set connect to true = 1
	protected $table_name;			# this data is to set table name
	protected $result = array();	# set result to array of blank
	protected $rst;
	
	# private fields
	private $error = null;			# make string error = null
	private $query_string = null;	
		
	# protected fields, define constant error string
	protected $ERROR_QUERY = "Could not select table data: ";				# constant query error
	protected $ERROR_INSERT = "Could not insert new data to table: ";		# constant insert error
	protected $ERROR_DELETE = "Could not delete data from table: ";			# constant delete error
	protected $ERROR_UPDATE = "Could not update data from table: ";			# constant update error
	
	# Call Database constructor everytime instantiate an object
	public function __construct() {
		try {
			if($this->Connect()) {
				$this->query("set names 'utf8'","");
				return $this->connect;			
			} else {							
				echo $this->error;
				return $this->connect = 0;				
			}
		} catch(Exception $e) {
			die('ERROR: Unable to connect to server' . mysql_error());			
		}
	}	
	
	# private function Connect
	private function Connect() {
		if(@mysql_connect(SERVER_HOST,SERVER_USER,SERVER_PASS)) {
			$this->query("SET character_set_results=utf8","");
			mb_language('uni');
			mb_internal_encoding('UTF-8');
			if(mysql_select_db(DB_NAME)) {
				return true;				
			} else {
				$this->error = "Undefined database name: " .DB_NAME;
			}
		} else {
			$this->error = "Could not connect to the server";
		}
	}
	
	# protected function query
	protected function query($string,$err) {
		$this->query_string = mysql_query($string);
		if($this->query_string) {		
			mysql_query("SET character_set_client=utf8");
		//$this->query("SET character_set_client=utf8", "");
		//$this->query("SET character_set_connection=utf8", "");
			mysql_query("SET character_set_connection=utf8");
			return $this->query_string;
		} else {			
			echo $err.'<br/>'.@mysql_error();
			die();
		}
	}
	
	# function to return the number of result rows
	protected function return_rows() {
		return mysql_num_rows($this->query_string);
	}
	
	# result return to object
	protected function result_to_object() {
		for($count=0; $row=mysql_fetch_object($this->query_string); $count++) {
			$this->result[$count] = $row;
		}
		return $this->result;
	}	
	
	# result return to row
	protected function result_to_row() {
		for($count=0; $row=mysql_fetch_row($this->query_string); $count++) {
			$this->result[$count] = $row;
		}
		return $this->result;
	}
	
	# result return to each array
	protected function result_to_array() {		
		$this->rst = mysql_fetch_array($this->query_string);
		return $this->rst;
	}
		
	# function to avoid sql injection
	function escape_string($string) {
		return mysql_real_escape_string($string);
	} // end escape_string function
	
	# redirect method
	protected function redirect_to($url=null) {
		header("location: $url");
	}
	
	# function to disconnect the connection; could also be destructor
	protected function DisConnect() {
		if(mysql_close($this->Connect())) {
			$this->redirect_to(SERVER_URL);
		}
	}
	
	# function destructor to close mysql connection
	/*protected function __destruct() {
		
	}*/
	
					
}

# instantiate a new object
$db = new Database();



?>