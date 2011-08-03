<?php
	/**
	 * Simple database handling with functions
	 * - store the database connection resource in global variable to know if a connection exists already
	 * - connect function to connect and select db if not connected already
	 * - query the db (auto connect) and return the results (in array format for select queries)
	 * - custom function to make a query and create a list form the retrieved data
	 *
	 * PHP Functions: http://www.php.net/manual/en/language.functions.php
	 * Global variables within functions: http://www.php.net/manual/en/language.variables.scope.php
	 */

	// store db connection resource identifier or null if not connected
	$db = null;
	
	// connect to database if needed
	function db_connect() {
		global $db;
		if($db) { // already connected, no need to create connection
			return 1;
		}
		$db = mysql_connect('localhost','user','pass') or die('DB connection failed');
		mysql_select_db('mydb') or die('DB selection failed');
	}
	
	// process query - connect to db, execute query, 
	// - if it was a select query then return result multi-dimension associative array
	// - else return the return value of mysql_query, which should be true/false mainly
	function db_query($query) {
		db_connect();
		$rs = mysql_query($query) or die('DB bad query');
		if(strtolower(substr($query,0,6))==='select') {
			$arr = array();
			while($row = mysql_fetch_assoc($rs)) { // retrieve rows in associative array form
				$arr[] = $row;
			}
			mysql_free_result($rs); // free memory
			return $arr;
		} else {
			return $rs;
		}
	}
	
	// list my stuff - execute select query, get results and generate list from it
	function get_my_stuff() {
		$stuff = db_query('SELECT * FROM stuff');
		echo "<h2>My stuff</h2>";
		echo '<ul class="stuff">';
		foreach($stuff as $thing) {
			 echo "<li>{$thing['name']}</li>";
		}
		echo '</ul>';
	}
	
	// list our stuff
	get_my_stuff();
?>