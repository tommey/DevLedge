<?php

/**
 * Handles the main pages actions.
 */
class IndexController
{
    /**
     * Displays the things in html table format.
     */
    function doIndex()
	{
		$model  = new ThingModel();
		$things = $model->getList();
		
		$view = new ThingView($thing);
		$view->render();
	}
}
