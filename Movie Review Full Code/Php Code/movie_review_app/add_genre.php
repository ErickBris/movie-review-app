<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
	include('messages/messages.php');
	require_once("thumbnail_images.class.php"); 
  
   	mysql_query("SET NAMES 'utf8'");	

 	if(isset($_POST['submit']))
	{
    						                  $data = array(											                                                       'genres_name'  =>  $_POST['genres_name'],
											  );		
 					  $qry = Insert('tbl_genres',$data);									
  					  $_SESSION['msg']="16";
					  header( "Location:manage_genre.php");
					  exit;
 	}
?>
<script src="js/jquery-1.9.1.min.js"></script>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript">
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#add_genres").validate({
                rules: {
                                        genres_name: "required",
										 
  									 
   									},
                 messages: { 
										 genres_name: "Please enter Genres Name",
                  },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>
<style>

#add_genres label.error {
    color: #FB3A3A;
    display: inline-block;
    margin: 4px 0 5px 20px;
    padding: 0;
    text-align: left;
    width: auto;
}
</style>

        <div id="content" class="span10">
 			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
                
                  <li>
					<i class="icon-table"></i>
					<a href="manage_genre.php">Manage Genres</a>
					<i class="icon-angle-right"></i> 
				 </li>
				
                 <li>
					<i class="icon-plus"></i>
					<a href="#">Add Genres</a>
				</li>
            </ul>
                        
                        <div class="row-fluid">
                        <div class="box span12">
                        <div class="box-header" data-original-title>
						<h2><i class="icon-plus"></i><span class="break"></span>Add Genres</h2>
						 
                        </div>
                        <div class="box-content">
                        <p style="color:#990000; font-size:14px;" align="center">
                            <?php if(isset($_SESSION['msg'])){ 
                            ?>
						
                            <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?php echo $admin_lang[$_SESSION['msg']] ; ?>
						    </div>
            	           
							<?php unset($_SESSION['msg']);		
                                    
                            }?>
                </p>
                <form id="add_genres" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $_GET['genre_id'];?>" />
                <fieldset>
                 
				<div class="control-group">
				<label class="control-label" for="#">Genres Name</label>
				<div class="controls">
				<input type="text" class="span6 typeahead" name="genres_name" id="genres_name" value="">
 				</div>
		        </div>
               
                <div class="form-actions">
			    <button type="submit" name="submit" class="btn btn-primary">Add Genres</button>
			    </div>
				</fieldset>
				</form>   
 			    </div>
				</div><!--/span-->

			</div><!--/row-->
            </div>			

<?php include('includes/footer.php');?>                  