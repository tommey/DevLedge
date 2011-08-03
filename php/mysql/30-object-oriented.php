<?php
	/**
	 * Object Oriented usage
	 * - wrap previous database functions and the global variable into a class
	 * - create custom class which will use it
	 * - note: this code is php4, you can understand the OO database handling
	 *         from it, but in production you should use php5's new way
	 *         with private/protected/public things, __construct() and other
	 *         newer features of it
	 *
	 * PHP Classes: http://www.php.net/manual/en/language.oop5.php
	 */

   // database handling class
   class DB {
      // store db connection resource identifier or null if not connected
      var $db = null;
      // connect to database if needed
      function connect() {
         if($this->db) { // already connected, no need to create connection
            return 1;
         }
         $this->db = mysql_connect('localhost','user','pass') or die('DB connection failed');
         mysql_select_db('mydb') or die('DB selection failed');
      }
      // process query - connect to db, execute query, 
      // - if it was a select query then return result multi-dimension associative array
      // - else return the return value of mysql_query, which should be true/false mainly
      function query($query) {
         this->connect();
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
   } // end of DB class;

   // class for handling my stuff
   class MyStuff {
      // own database object or null before initialization
      var $db = null;
      // constructor to set up the database object
      function MyStuff() {
         $this->db = new DB();
      }
      // list my stuff - execute select query, get results and generate list from it
      function listAll() {
         $stuff = $this->db->query('SELECT * FROM stuff');
         echo "<h2>My stuff</h2>";
         echo '<ul class="stuff">';
         foreach($stuff as $thing) {
             echo "<li>{$thing['name']}</li>";
         }
         echo '</ul>';
      }
   } // end of MyStuff class;
   
   $myStuff = new MyStuff();
   $myStuff->listAll();
?>