<div class="container">
<?php
$db = \Config\Database::connect();
$query   = $db->query('SELECT title, body, slug FROM news');
$results = $query->getResult();

foreach ($results as $row) {
	echo "<div class='py-3'>";
    echo "<h3>".$row->title."</h3>";
    echo $row->body;
    echo "<br/>";
    echo "<a href='/news/".$row->slug."'>View article</a>";
    echo "</div>";
}

echo 'Total Results: ' . count($results);
?>
</div>