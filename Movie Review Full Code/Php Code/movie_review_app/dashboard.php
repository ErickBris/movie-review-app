<?php include("includes/header.php");?>
<?php include("includes/menu.php");

 
 
$sql="SELECT COUNT(*) as num FROM tbl_category";
$total_features= mysql_fetch_array(mysql_query($sql));
$total_features = $total_features['num'];

$sql="SELECT COUNT(*) as num FROM tbl_actors";
$total_actors= mysql_fetch_array(mysql_query($sql));
$total_actors = $total_actors['num'];

$sql="SELECT COUNT(*) as num FROM tbl_movie";
$total_movie= mysql_fetch_array(mysql_query($sql));
$total_movie = $total_movie['num'];

$sql="SELECT COUNT(*) as num FROM tbl_genres";
$total_genres= mysql_fetch_array(mysql_query($sql));
$total_genres = $total_genres['num'];

$sql="SELECT COUNT(*) as num FROM tbl_registration";
$total_user= mysql_fetch_array(mysql_query($sql));
$total_user = $total_user['num'];
 
?>

<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="dashboard.php">Dashboard</a></li>
			</ul>
  			<div class="row-fluid">
  			<div class="row-fluid">	
             
                
				<a href="manage_category.php" class="quick-button metro red span2">
					<i class="icon-list"></i>
					<p>Category List</p>
					<span class="badge"><?php echo $total_features;?></span>
				</a>
                
                  <a href="manage_actors.php" class="quick-button metro black span2">
					<i class="icon-font"></i>
					<p>Actors List</p>
					<span class="badge"><?php echo $total_actors;?></span>
				</a>
                
                <a href="manage_movie.php" class="quick-button metro green span2">
					<i class="icon-play-circle"></i>
					<p>Movie List</p>
					<span class="badge"><?php echo $total_movie;?></span>
				</a>
				
				 <a href="manage_genre.php" class="quick-button metro orange span2">
					<i class="icon-th-large"></i>
					<p>Genres List</p>
					<span class="badge"><?php echo $total_genres;?></span>
				</a>
				 
				 <a href="manage_user.php" class="quick-button metro pink span2">
					<i class="icon-fixed-width"></i>
					<p>User List</p>
					<span class="badge"><?php echo $total_user;?></span>
				</a>
				
				<div class="clearfix"></div>
								
			</div><!--/row-->	 
 			
			</div>
</div><!--/.fluid-container-->
	
<!-- end: Content -->

<?php include("includes/footer.php");?>