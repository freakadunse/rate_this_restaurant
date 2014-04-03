<article class="posts">
    <?php
    $counter = 1;
    $anzahl_lokale = count($this->_['lokale']);
    foreach($this->_['lokale'] as $lokal):?>  
        <div class="post <?php if ($counter == $anzahl_lokale): echo 'last'; endif;?>"> 
            <h2><a href="?view=detail&id=<?php echo $lokal->lokal_id ?>"><?php echo $lokal->name; ?></a></h2>  
            <p><?php echo $lokal->anschrift; ?></p>  
        </div>
        <?php
        $counter++;  
    endforeach;  ?>
</article>