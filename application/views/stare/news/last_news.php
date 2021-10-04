<ol>
<?php
	foreach($news as $row) {
		echo '<li>'.anchor("portal/show_news/$row->id_news", "$row->title_news").'</li>';
	}
?>
</ol>