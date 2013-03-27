<?php

/**
 * Handles the things' data.
 */
class ThingModel
{
    /**
     * Returns the [id, name] list of all the things.
     * 
     * @return array
     */
    public function getList()
	{
        // Gets the singleton object of the database.
        // Creates connection to the users DB with PDO.
        // @see http://php.net/pdo
		$db = DB::getInstance('users');
		
		return $db->query('SELECT id, name FROM things')->fetchAll();
	}
}
