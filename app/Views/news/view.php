<div class="container">
<?php
	$db = \Config\Database::connect();
	$builder = $db->table('news')->getWhere(['slug' => $slug]);
	$results = $builder->getResult();
	foreach($results as $row){
		echo "<h2>".$row->title."</h2>";
		echo "<br/>";
		echo $row->body;
	}
?>
</div>