<article class="posts">
    <?php
    $firstline = true;
    $anzahl_posts = count($this->_['posts']);
    $counter = 1; 
    foreach($this->_['posts'] as $post):
        if($firstline):?>
            <div class="posts_header">
                <h2><?php echo $post->name; ?></h2>  
                <p><?php echo $post->anschrift;?></p>
            </div>
            <?php 
            $firstline = false;
        endif;?>
        <div class="post<?php if ($counter == $anzahl_posts): echo ' last'; endif;?>">  
            <p><?php echo $post->text;?></p>
            <a href="?view=default">Zur&uuml;ck zur &Uuml;bersicht</a>
        </div>
        <?php 
        $counter++;
    endforeach;?>
</article>