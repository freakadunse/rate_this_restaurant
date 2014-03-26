<article class="posts">
    <?php
    $counter = 1;
    $anzahl_einrichtungen = count($this->_['einrichtungen']);
    foreach($this->_['einrichtungen'] as $einrichtung):?>  
        <div class="post <?php if ($counter == $anzahl_einrichtungen): echo 'last'; endif;?>"> 
            <h2><a href="?view=detail&id=<?php echo $einrichtung->einrichtung_id ?>"><?php echo $einrichtung->name; ?></a></h2>  
            <p><?php echo $einrichtung->anschrift; ?></p>  
        </div>
        <?php
        $counter++;  
    endforeach;  ?>
</article>