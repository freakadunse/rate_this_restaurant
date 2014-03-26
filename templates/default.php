<?php
foreach($this->_['entries'] as $entry){?>  
    <h2><a href="?view=entry&id=<?php echo $entry->lokal_id ?>"><?php echo $entry->name; ?></a></h2>  
    <p><?php echo $entry->anschrift; ?></p>  
<?php  
}  