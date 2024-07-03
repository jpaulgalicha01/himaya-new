<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "GET"){
	if(isset($_GET['value']) && $_GET['function']=="fetching_img"){
		$value = $_GET['value'];
		?>

		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title fs-5" id="product_name">Add Images</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
		      	<input type="hidden" name="function" value="add_img_prod">
		        <input type="hidden" name="prod_img_id" value="<?=$value?>">
		            <div class="modal-body">
		            		<label>Add Images: </label>
		            		<input type="file" name="upload_images[]" multiple class="form-control">
		            	<div class="table-responsive mt-3">
		            		<table class="table table-light table-striped">
			               		<thead class="table-dark">
			               			<tr>
			               				<th>Image</th>
			               				<th>Action</th>
			               			</tr>
			               		</thead>
			               		<tbody>
			               			<?php
			               				$fetch_img = new  fetch();
			               				$res_fetch_img = $fetch_img->fetchImg($value);

			               				if($res_fetch_img->rowCount()>0){
			               					while($row = $res_fetch_img->fetch()){
			               						?>
			               							<tr>
							               				<td>
							               					<a href="../uploads/<?=$row['img_name']?>" target="__blank">
							               						<img src="../uploads/<?=$row['img_name']?>" width="70" height="50">
							               					</a>
							               				</td>
							               				<td width="70%">
							               					<a href="inputConfig.php?delete_prod_img=<?=$row['img_id']?>" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> <small>Delete</small></a>
							               				</td>
							               			</tr>
			               						<?php
			               					}
			               				}else{
			               					echo "<tr><td colspan='2' class='text-center'>NO Data Found</td></tr>";
			               				}
			               			?>
			               		</tbody>
			               </table>
		            	</div>
		           </div>
		           <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-primary" name="add_img_prod">Upload Images</button>
		           </div>
		      </form>

		    </div>

		<?php
	}else{
		ob_end_flush(header("Location: index.php"));
	}
}else{	
	return false;
}
?>