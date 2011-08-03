<?php
	/**
	 * Very Basic MySQL usage
	 * - our goal is to retrive a table's data and print it in a html list
	 * - these are really the very very basics, you should NOT use this in production
	 * 
	 * PHP MySQL reference: http://www.php.net/manual/en/book.mysql.php
	 */

	// connect to mysql database on localhost with user:password or die if not possible
	mysql_connect('localhost','user','pass') or die('DB connection failed');
	// select database to use - on most webservice providers this is the same as the user name
	mysql_select_db('mydb') or die('DB selection failed');
	// select all columns from the stuff table
	$rs = mysql_query('SELECT * FROM stuff') or die('DB bad query for selecting stuff');
	// print a title
	echo "<h2>My stuff</h2>";
	// print the retrieve data to an unordered list, retriving line by line
	echo '<ul class="stuff">';
	while($row = mysql_fetch_assoc($rs)) {
		echo "<li>{$row['name']}</li>";
	}
	echo '</ul>';
	// free up the memory used by the result set
	mysql_free_result($rs);
	// this is not needed, php automatically closes all resources at the end
	// however you would need it if you handle more then one connections
	mysql_close();
?>