<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rate this!</title>
	<link href="public/css/style.css" rel="stylesheet" />
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<script src="public/js/jquery.js"></script>
	<script src="public/js/extra.js"></script>
</head>

<body>
<div id="page">
    <div id="header">
        <h1><?php echo $this->_['home_title']; ?></h1>  
        
        <div id="nav_top">
            <ul>
                <li><p><a href="/">Home</a></p></li>
                <li><p>Neuer Eintrag</p></li>
                <li><p>Dummy</p></li>
                <li><p><a href="/?new=einrichtung">Neue Einrichtung</a></p></li>
            </ul>
            <form id="search" method="post" action="/">
                <input name="search" type="search" placeholder="Suchbegriff eingeben ..." />
            </form>
        </div>
    </div>
    
    <div id="content">
        <div id="container_posts">
            
    	        <?php echo $this->_['home_content']; ?>
	       
    	</div>
    
    </div>
	

	<div id="footer">
	    <?php echo $this->_['home_footer']; ?>
	</div>
</div>
</body>
</html>