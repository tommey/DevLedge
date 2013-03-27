<?php

/**
 * Displays the list of things in an html table.
 */
class ThingView
{
    private $things;
    
    /**
     * Constructor - saves the data for rendering.
     */
    public function __construct(array $things)
    {
        $this->things = $things;
    }
    
    /**
     * Renders the Things Page.
     */
    public function render()
    {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Things</title>
</head>
<body>
    <h1>Things</h1>
    <table>
		<thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
		<tbody>
		<?php foreach ($this->things as $things) : ?>
			<tr>
                <td><?=$things['id']?></td>
                <td><?=$things['name']?></td>
            </tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
<?php
    }
}
