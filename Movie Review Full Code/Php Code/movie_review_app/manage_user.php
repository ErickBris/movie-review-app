
<?php include("includes/header.php");?>
 <?php include("includes/menu.php");?>

<?php
	include('includes/function.php');
	include('messages/messages.php'); 
 	
	mysql_query("SET NAMES 'utf8'");	
 	
 	//Get all owners
	 $qry="SELECT * FROM tbl_registration ORDER BY tbl_registration.id";
	 $result=mysql_query($qry);
	
 	//Delete Player
	if(isset($_GET['id']))
	{
 		Delete('tbl_registration','id='.$_GET['id'].'');
		
		$_SESSION['msg']="7";
		header( "Location:manage_user.php");
		exit;
 	}
 ?>

<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="manage_user.php">User List</a></li>
			</ul>
   					<br/>
         <div class="row-fluid">	
				<div class="box span12">

					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>User List</h2>
						 
					</div>
					<div class="box-content">
						<?php if(isset($_SESSION['msg'])){ 
						?>

					<div class="alert alert-info">
       					 <button type="button" class="close" data-dismiss="alert">×</button>
        				 <?php echo $admin_lang[$_SESSION['msg']] ; ?>
   					 </div>
                              <?php unset($_SESSION['msg']);		
 					}?>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
																							         		
						  <thead>
							  <tr>
                              <th>User Name</th>
                              <th>Email Address</th>
                             
                              <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                
                             <?php 
									$i=1;
									while($row=mysql_fetch_array($result))
									{
								?>
                <tr>
                   <td><?php echo $row['username'];?></td>
                      <td><?php echo $row['email'];?></td>
                      
                        
                    <td class="center">
                      <a class="btn btn-danger" href="manage_user.php?id=<?php echo $row['id'];?>" title="Delete taxi" onClick="return confirm('Delete this User List?')">
                      <i class="halflings-icon white trash"></i> 
                    </a>
 
                      
                  </td>
                </tr>
                <?php
									}
								?>
							  
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			
			</div>
       
		
	</div><!--/.fluid-container-->
	
<!-- end: Content -->

<?php include("includes/footer.php");?>