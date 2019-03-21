 <?php
  include 'connection.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajax Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



  <style type="text/css">
   i
   {
    color: dodgerblue;  
   }
  </style>
</head>
<body>

<div class="container">

<br/>
<br/>
<br/>
<br/>
  <h2>List of User</h2>          
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
		  $sql = "SELECT * FROM user";
		  $result = mysqli_query($connection,$sql);
             while ($row = mysqli_fetch_assoc($result)){ ?>
              <tr id="<?php echo $row['id']; ?>">
                <td data-target="name"><?php echo $row['name']; ?></td>
                <td data-target="email"><?php echo $row['email']; ?></td>
                <td><i class="fas fa-edit" href="#" data-role="update" data-id="<?php echo $row['id'] ;?>"></td>
              </tr>
         <?php }
       ?>
       
    </tbody>
  </table>

  
</div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">User Details</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label> Name</label>
                <input type="text" id="name" class="form-control">
              </div>
               <div class="form-group">
                <label>Email</label>
                <input type="text" id="email" class="form-control">
              </div>
                <input type="hidden" id="userId" class="form-control">


          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-success pull-right">Save</a>
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

</body>

<script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','i[data-role=update]',function(){
            var id  = $(this).data('id');
            var name  = $('#'+id).children('td[data-target=name]').text();
            var phone  = $('#'+id).children('td[data-target=phone]').text();
            var email  = $('#'+id).children('td[data-target=email]').text();

            $('#name').val(name);
            $('#phone').val(phone);
            $('#email').val(email);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
          var id  = $('#userId').val(); 
         var name =  $('#name').val();
          var phone =  $('#phone').val();
          var email =   $('#email').val();

          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {name : name , phone: phone , email : email , id: id},
              success  : function(response){
                            // now update user record in table 
                             $('#'+id).children('td[data-target=name]').text(name);
                             $('#'+id).children('td[data-target=phone]').text(phone);
                             $('#'+id).children('td[data-target=email]').text(email);
                             $('#myModal').modal('toggle'); 

                         }
          });
       });
  });
</script>

<script type="text/javascript">
  $(".table").dataTable();
</script>
</html>
