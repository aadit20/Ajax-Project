<?php
$connection =	mysqli_connect('localhost' , 'root' ,'' ,'registration');




if(isset($_POST['email'])){
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$id = $_POST['id'];

	//  query to update data 
	 
	$result  = mysqli_query($connection , "UPDATE contact SET name='$name' , email = '$email' WHERE id='$id'");
	if($result){
		echo 'data updated';
	}

}
?>