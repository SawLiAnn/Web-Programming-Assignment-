<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src = "../../JS/form.js">
    
  </script>
  <script src = "../../JS/main.js">
    
  </script>
  <style>
    body{
      overflow-x:hidden ;
    }
  </style>
</head>


<body>

<?php
    include_once "../../PHP/db_connection.php";
    session_start();

    $username = $_SESSION["username"]; 
    $role = $_SESSION["role"]; 
    $sql = "SELECT * FROM registration_detail WHERE username='$username'";
    $result = mysqli_query($conn, $sql) or die("Error due to " . mysqli_error($conn));
    $data = mysqli_fetch_array($result, MYSQLI_BOTH);
    $_SESSION["old_cat"] = $data["category_id"];
    if(isset($username) and $role == "user"){

?>
  <div class="container-fluid p-0">
    <div class="row">
     <div class="col-xl-2 d-flex flex-column flex-shrink-0 p-3 bg-light" style="height:100vh; position:fixed">
      <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Runner's World</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="account.php" class="nav-link link-dark " aria-current="page">
           <i class="fa-solid fa-user"></i>
            Account
          </a>
        </li>
        
        <li>
          <a href="#" class="nav-link active ">
            <i class="fa-solid fa-table-columns"></i>
             Event 
          </a>
        </li>
      
        <li>
          <a href="../../PHP/logout.php" class="nav-link link-dark">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Logout 
          </a>
        </li> 
      </ul>
      </div>
    <div class="container col-xl-5 ">
    <div  class="pt-5 pb-3 jumbotron">
      <h1>Event</h1>
      <hr>
      <form method="post"  onsubmit="return false">
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username" value="<?php  echo "$data[1]"; ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="student_id" class="col-sm-2 col-form-label">Student ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="student_id" class="form-control" id="student_id" value="<?php echo "$data[2]"; ?>">
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Category</legend>
                    <div class="col-sm-10">
                    <div class="col-sm-10">
                      <?php 
                        include_once "../../PHP/user_dashboard/get_category.php";
                        for($i = 0; $i< count($output);$i++){
                          $isDisabled;

      
                          if($output[$i][2] >$output[$i][3]){
                            $isDisabled = false; 
                          }else{
                            $isDisabled = true; 

                          }

                          
                          echo '
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="category_id" value="'.$output[$i][0].'"';

                          if($isDisabled && strcmp($data["category_id"],$output[$i][0])){
                            echo "disabled";
                          }

                          if($output[$i][0] == $data["category_id"]){
                              echo " checked";
                          }


                          echo'> 
                            <label class="form-check-label" >
                            '.$output[$i][1].'
                            </label>
                          </div>
                          ';
                        }
                      
                      ?>
                    </div>
                </fieldset>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="Female" value="female" <?php if (!strcmp($data["gender"],"female")) echo "checked" ?> >
                            <label class="form-check-label" for="Female">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="Male" value="male" <?php if (!strcmp($data["gender"],"male")) echo "checked" ?> >


                            <label class="form-check-label" for="Male">
                                Male
                            </label>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <label for="phone_no" class="col-sm-2 col-form-label">Phone no</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone_no" class="form-control" id="phone_no" value="<?php echo "$data[5]"; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" id="address" rows="5"><?php echo "$data[6]"; ?></textarea><br>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" onclick =  "updateDetails()">Update</button>
            </form>

    </div>
  </div>
    </div>
  </nav>

  <?php
        } else {
          echo "No session exist. Please login. ";
        }
        ?>
</body>

<script>
  function updateDetails(){
    var old = "<?php echo $_SESSION['old_cat'] ?>"
    var username = document.getElementById("username");
    var student_id = document.getElementById("student_id");
    var category_id = document.querySelector('input[name = category_id]:checked')
    var gender = document.querySelector('input[name = gender]:checked')
    var phone_no = document.getElementById("phone_no");
    var address = document.getElementById("address");

    
    if(!register_event()){
      return false;
    }else{
      $.ajax({
      type: "POST",
      url: "../../PHP/update_event.php",
    
      success: function(response){
        alert(response);
        location.reload()

      },
      
      data:{
        "username":username.value,
        "student_id":student_id.value,
        "newval":category_id.value,
        "gender":gender.value,
        "phone_no":phone_no.value,
        "oldval": old,
        "address":address.value
        
    
   

    
      },
  

      error: function(){
        alert("error");
    }
  }); 
    }
  }
  
</script>
</html>