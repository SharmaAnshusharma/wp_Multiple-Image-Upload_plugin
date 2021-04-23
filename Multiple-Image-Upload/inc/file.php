
<?php
$success_msg = "";
$error_msg = "";
if(isset($_POST['submit']))
{
	global $wpdb;
	$files = $_FILES['multiple'];
	foreach ($files['name'] as $key => $value) {
		if($files['name'][$key])
		{
			$file = array(
				'name'=>$files['name'][$key],
				'type'=>$files['type'][$key],
				'tmp_name'=>$files['tmp_name'][$key],
				'error'=>$files['error'][$key],
				'size'=>$files['size'][$key],
			);
			$_FILES = array("multiple"=>$file);
			foreach($_FILES as $file=>$array)
			{
				$attachment_id = media_handle_upload("multiple",0);
			}
			
			
			$query = $wpdb->insert("wp_multiple_image_upload",array("images"=>$attachment_id));

			if (is_wp_error($attachment_id) && empty($query))
			{
                echo "Error adding file";
            }
            /*else
            {
            	
                //echo wp_get_attachment_image($attachment_id, array(200, 100));
            }*/
			
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Multiple Images</title>
</head>
<body>
	<div class="container">
		<?php
		if(isset($success_msg) && $success_msg !='')
		{
			?>
				<p class="alert alert-success"><?php echo $success_msg; ?></p>
			<?php
		}
		if(isset($error_msg) && $error_msg !='')
		{
			?>
				<p class="alert alert-danger"><?php echo $error_msg; ?></p>
			<?php
		}
		?>
		<form id="frontpost" method="post" enctype="multipart/form-data">
		    <input type="file" multiple name="multiple[]">
		    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
		    <input type="submit" name="get" value="Get Images" class="btn btn-success">
		</form>
	</div>
</body>
</html>
<?php
if(isset($_POST['get']))
{

/*	$page = 1/*$_GET['page_no']*/;
/*	if($page == "" || $page == "1")
	{
		$page1 = 0;
	}
	else
	{
		$page1 = ($page*5)-5;
	}
*/	global $wpdb;
	$results = $wpdb->get_results("SELECT * FROM `wp_multiple_image_upload` ");
    if($results > 0)
    {

            ?>
            <table class="table table-striped table-hovered">
                <tr>
                    <th>SR No.</th>
                    <th>Image</th>

                </tr>
            <?php
            $count=1;
            foreach($results as $index=> $value)
            {
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo wp_get_attachment_image($value->images, array(200, 100)); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
            <?php
        }
        else
        {
            echo "<h1>No Data found</h1>";
        }

}
/*global $wpdb;
$count = $wpdb->get_var("SELECT COUNT(*) FROM `wp_multiple_image_upload`");
$num_of_record_per_page = $count/5;
$total_pages = ceil($num_of_record_per_page);
*/
?>
<!-- <div id="pagination" align="center">
<?php 
        for($i=1; $i <= $total_pages; $i++){
            if($i == $page){
               $class_name = "active";
           }else{
              $class_name = "";
            } ?>
          <a class="class_name" id="<?php echo $i; ?>" href=''><?php echo $i; ?></a>
      <?php } ?>

</div>
 -->



