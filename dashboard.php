<!DOCTYPE html>
<?php
session_start();
// include('config/config.php');

// if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
//     header("Location: login.php");
//   }
//   $id = $_SESSION['id'];

// Initialize error messages array
$errors = array();

  // Connect to the database
  $db = new PDO('mysql:host=localhost;dbname=sports_db', 'root', '');
include("includes/conn.php");
if(isset($_POST['addsport']) && !empty($_POST['name'])
   ){

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

       $name = test_input(mysqli_real_escape_string($conn, $_POST['name']));
    
        $sql = "INSERT INTO `game_tbl`(`name`) VALUES ('$name')";
        $result = mysqli_query($conn, $sql);

        echo "<script>alert('Game Added Successfully');</script>";
       }
    // Process form submission
if (isset($_POST['addstaff'])  && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
      $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format.";
    }
  
    // Validate password
    $password = trim($_POST['password']);
    if (empty($password)) {
      $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
      $errors[] = "Password must be at least 6 characters.";
    }
  
    // Validate name
    $name = trim($_POST['name']);
    if (empty($name)) {
      $errors[] = "Name is required.";
    }
  
    // Validate address
    $phone = trim($_POST['phone']);
    if (empty($phone)) {
      $errors[] = "Phone is required.";
    }
  
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  // echo $hashedPassword;
    // Check if email address is already in use
    $stmt = $db->prepare("SELECT * FROM admin_tbl WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
      $error[] = 'Email address is already in use';
    }
    $role = "Admin";
    // If no errors, proceed with registration
    if (empty($errors)) {
      // Add user to the database
      $stmt = $db->prepare("INSERT INTO admin_tbl (email, password, name, phone, role) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$email, $hashedPassword, $name, $phone, $role]);
      // Redirect to dashboard
      // header('Location: logout.php');
      // exit();
    } 
  
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="resource/css/style.css">
    <link rel="stylesheet" href="resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="resource/css/font-awesome.min.css">    
    <link rel="stylesheet" href="resource/css/tooplate-style.css">
    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <script src="includes/js/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>

    
     
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="resource/pics/sport.png" alt=""> 
             </div>

             <span class="logo_name">Pantami Sport Center</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="fa fa-home"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="viewteams.php">
                    <i class="fa fa-clone"></i>                    
                    <span class="link-name">Manage Teams</span>
                </a></li>
                <li><a data-toggle="modal" data-target="#addstaff">
                    <i class="fa fa-user-plus"></i>
                    <span class="link-name">Create Staff</span>
                </a></li>
                <li><a href="#new">
                    <i class="fa fa-users"></i>
                    <span class="link-name">New Teams</span>
                </a></li>
                <li><a href="#score">
                    <i class="fa fa-check"></i>
                    <span class="link-name">Update Lifescore</span>
                </a></li>
                <li><a data-toggle="modal" data-target="#tour">
                    <i class="fa fa-plus-square"></i>
                    <span class="link-name">Create Tournament</span>
                </a></li>
                <li><a data-toggle="modal" data-target="#addsport">
                    <i class="fa fa-plus-square"></i>
                    <span class="link-name">Add Sport</span>
                </a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="fa fa-sign-out"></i>
                        <span class="link-name">Logout</span>
                </a></li>
                <li class="mode">
                    <a href="">
                        <i class="fa fa-moon-o"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard dashboard-background">
        <div class="top">
            <i class="fa fa-bars sidebar-toggle"></i>
            
            <div class="search-box">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

           <a href="adminprofile.php"><img src="resource/pics/profile.png" alt=""></a>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-dashboard"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="fa fa-cubes"></i>
                        <span class="text">Total Sports</span>
                        <span class="number">0
                        <?php 
                    //  $sql = "SELECT count(*) as alldept FROM dept";
                    //  $result = mysqli_query($conn, $sql);
                    //  $data = mysqli_fetch_assoc($result);
                    //  echo $data['alldept'];
                    //  mysqli_free_result($result);
                     ?>
                        </span>
                    </div>
                    <div class="box box2">
                        <i class="fa fa-users"></i>
                        <span class="text">Total Teams</span>
                        <span class="number">0
                        <?php 
                    //  $sql = "SELECT count(*) as allstaff FROM staff";
                    //  $result = mysqli_query($conn, $sql);
                    //  $data = mysqli_fetch_assoc($result);
                    //  echo $data['allstaff'];
                    //  mysqli_free_result($result);
                     ?>
                        </span>
                    </div>
                    <div class="box box3">
                        <i class="fa fa-sitemap"></i>
                        <span class="text">Total Tournament</span>
                        <span class="number">0
                        <?php 
                    //  $sql = "SELECT count(*) as allstaff FROM staff";
                    //  $result = mysqli_query($conn, $sql);
                    //  $data = mysqli_fetch_assoc($result);
                    //  echo $data['allstaff'];
                    //  mysqli_free_result($result);
                     ?>
                        </span>
                    </div> 
                </div>
            </div>

            <div class="activity" id="new">
                <div class="title">
                    <i class="fa fa-clock-o"></i>
                    <span class="text">New Teams</span>
                </div>

                <div class="activity-data">
                    <table class="table black">
                        <thead>
                            <tr >
                            <th>S/N</th>
                            <th>Team Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Game type</th>
                            <th>Address</th>
                            <th>Profile</th>
                            <th>Accept</th>
                            </tr>
                        </thead>
                        <?php
                        $selquery ="SELECT * FROM team_tbl WHERE status = 'pending'";
                        //bind connection with query
                        $resl = mysqli_query($conn, $selquery);
                        //loop through the table
                        $j = 0;
                        while($row = mysqli_fetch_assoc($resl)){

                        $j++;
                        $id = $row['id'];
                        ?>       
                        <tbody class="black">
                            <tr class="" >
                                <td class="center"> <?php echo $j;?></td>
                                <td class="center"> <?php echo $row['name'] ?></td>
                                <td class="center"> <?php echo $row['email'] ?></td>
                                <td class="center"> <?php echo $row['phone'] ?></td>
                                <td class="center"> <?php echo $row['game_type'] ?></td>
                                <td class="center"> <?php echo $row['address'] ?></td>
                                <td><a href="<?php echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td>
                                <td><a href="<?php echo 'accept.php?id='.$id; ?>"><span class="fa fa-check-square-o btn btn-success"></span></a></td>
                            </tr>
                            <?php }
                            mysqli_free_result($resl);
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="activity" id="score">
                <h1 class="black">Update lifescore</h1>
                <div class="boxes">
                    <div class="box box2">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label for="email">Game type:</label>
                            <select class="form-control" name="gamet" id="sel1">
                                <option>Football</option>
                                <option>Basket ball</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Current Games:</label>
                            <select class="form-control" name="game" id="game">
                                <option>match 1</option>
                                <option>Match 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nameTeam">Team:</label>
                            <select class="form-control" name="Team" id="Team">
                                <option>Team 1</option>
                                <option>Team 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="team">Score:</label>
                            <input type="text" class="form-control" name="score" required>
                        </div>
                        
                        <button class="btn btn-success button-full" type="submit" name="register">Update Score</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- Modal for addning admin-->
  <div class="modal fade" id="addstaff" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <span class="text">Create Staff</span>
        </div>
        <div class="modal-body">
        <div class="activity">
                <div class="title">
                </div>
                <!-- <form method="post" action="createadmin.php"> -->
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="boxes">
                    <div class="box box1">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required pattern=".{8,}" title="Password must be at least 8 characters long">
                        </div>
                        <button class="btn btn-success button-full" type="submit" name="addstaff">Create Staff</button>
                    </form>

                    </div>
                </div>
            </div>        
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- for adding sports -->
<!-- Modal -->
<div class="modal fade" id="addsport" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <span class="text">Create Sport</span>
      </div>
      <div class="modal-body">
      <div class="activity">
              <div class="title">
              </div>
              <!-- <form method="post" action="createadmin.php"> -->
              <?php if (!empty($errors)): ?>
              <div class="alert alert-danger">
                  <ul>
                  <?php foreach ($errors as $error): ?>
                      <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                  </ul>
              </div>
              <?php endif; ?>
              <div class="boxes">
                  <div class="box box1">
                  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <div class="form-group">
                          <label for="email">Sport Name:</label>
                          <input type="text" class="form-control" name="name" required>
                      </div>
                      <button class="btn btn-success button-full" type="submit" name="addsport">Add Sport</button>
                  </form>
                  </div>
              </div>
          </div>        
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- CREATE TOURNAMENT -->
<div class="modal fade" id="tour" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Schedule Training</h4>
        </div>
        <div class="modal-body">
        <div class="activity">
                <div class="title">
                </div>
                <!-- <form method="post" action="createadmin.php"> -->
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="boxes">
                    <div class="box box1">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label for="name">Tournament Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Number of Teams:</label>
                            <input type="text" class="form-control" name="number" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Game type:</label>
                            <select class="form-control" name="type" required>
                                <option>game 1</option>
                                <option>game 2</option>
                            </select>                        
                        </div>
                        <button class="btn btn-success button-full" type="submit" name="tour">Create Tournament</button>
                    </form>

                    </div>
                </div>
            </div>        
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <script src="resource/js/script.js"></script>
</body>
</html>