<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rate this!</title>
	<link href="public/css/style.css" rel="stylesheet" />
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
</head>

<body>
<div id="page">
    <div id="header">
        <h1><?php echo $this->_['blog_title']; ?></h1>  
        
        <div id="nav_top">
            <ul>
                <li><p>Home</p></li>
                <li><p>Neuer Eintrag</p></li>
                <li><p>Dummy</p></li>
                <li><p>Dummy</p></li>
            </ul>
            <form id="search">
                <input type="search" placeholder="Suchbegriff eingeben ..." />
            </form>
        </div>
    </div>
    
    <div id="content">
        <div id="container_posts">
    	    <?php echo $this->_['blog_content']; ?> 	
    	</div>
    
    </div>
	

	<div id="footer">
	    <?php echo $this->_['blog_footer']; ?>
	</div>
</div>
</body>
</html>


 
 
