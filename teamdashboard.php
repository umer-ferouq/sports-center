<!DOCTYPE html>
<?php
session_start();
// include('config/config.php');

// if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
//     header("Location: login.php");
//   }
//   $id = $_SESSION['id'];
include("includes/conn.php");

// Initialize error messages array
$errors = array();

  // Connect to the database
  $db = new PDO('mysql:host=localhost;dbname=sports_db', 'root', '');

// Process form submission
if (isset($_POST['addplayer'])  && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email
    $email = trim($_POST['email']);
    if (empty($email)) {
      $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format.";
    }
    $address = trim($_POST['address']);
    $gender = trim($_POST['gender']);
    $team_id = $_SESSION['user_id'];
    $game_type = $_SESSION['user_game'];
  
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
    // Validate kin name
    $kname = trim($_POST['kname']);
    if (empty($kname)) {
      $errors[] = "Next of kin Name is required.";
    }
  
    // Validate phone
    $phone = trim($_POST['phone']);
    if (empty($phone)) {
      $errors[] = "Phone is required.";
    }
    // Validate kin phone
    $kphone = trim($_POST['kphone']);
    if (empty($kphone)) {
      $errors[] = "Next of kin Phone is required.";
    }
  
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  // echo $hashedPassword;
    // Check if email address is already in use
    $stmt = $db->prepare("SELECT * FROM player_tbl WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
      $error[] = 'Email address is already in use';
    }
    $role = "Player";
    // If no errors, proceed with registration
    if (empty($errors)) {
      // Add user to the database
      $stmt = $db->prepare("INSERT INTO player_tbl (name, phone, email, password, address, gender, role, nok_name, nok_phone, game_type, team_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$name, $phone, $email, $hashedPassword, $address, $gender, $role, $kname, $kphone, $game_type, $team_id]);

      echo "<script>alert('Player Added Successfully');</script>";

      exit();
    }else
    echo "<script>alert('Failed to add Player');</script>";
  }
// Training form submission
if (isset($_POST['schedule'])  && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email
    $desc = trim($_POST['description']);
    if (empty($desc)) {
      $errors[] = "Description is required.";
    } 
    $time = trim($_POST['time']);
    $team_id = $_SESSION['user_id'];
    $game_type = $_SESSION['user_game'];
  
    // Validate loc
    $loc = trim($_POST['location']);
    if (empty($loc)) {
      $errors[] = "Location is required.";
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) {
      // Add user to the database
      $stmt = $db->prepare("INSERT INTO training_tbl (team_id, game_type, time, location, description) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$team_id, $game_type, $time, $loc, $desc]);
      echo "<script>alert('Training Added Successfully');</script>";
      header('Location: teamdashboard.php');
      exit();
    } else
    echo "<script>alert('Failed to add Training');</script>";

  }
// Match form submission
if (isset($_POST['add'])  && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email
    $desc = trim($_POST['description']);
    if (empty($desc)) {
      $errors[] = "Description is required.";
    } 
    $time = trim($_POST['time']);
    $team_id = $_SESSION['user_id'];
    $team_b_id = trim($_POST['team']);
    $game_type = $_SESSION['user_game'];
    $score = 0;
  
    // Validate loc
    $loc = trim($_POST['location']);
    if (empty($loc)) {
      $errors[] = "Location is required.";
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) { 
      // Add user to the database
      $stmt = $db->prepare("INSERT INTO `match_tbl`(`team_a_id`, `team_b_id`, `game_type`, `description`,
       `time`, `team_a_score`, `team_b_score`, `location`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$team_id, $team_b_id, $game_type, $desc, $time, $score, $score, $loc]);
      echo "<script>alert('Match Added Successfully');</script>";
      header('Location: teamdashboard.php');
      exit();
    } else
    echo "<script>alert('Failed to add Match');</script>";
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

    
     
    <title>Team Dashboard</title>
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
                <li><a data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-user-plus"></i>
                    <span class="link-name">Add Player</span>
                </a></li>
                <li><a href="#">
                    <i class="fa fa-users"></i>                    
                    <span class="link-name">Manage Matches</span>
                </a></li>
                <li><a data-toggle="modal" data-target="#creatematch">
                    <i class="fa fa-plus"></i>                    
                    <span class="link-name">Create Match</span>
                </a></li>
                <li><a data-toggle="modal" data-target="#trainingschedule">
                    <i class="fa fa-cubes"></i>
                    <span class="link-name">Trainings Schedule</span>
                </a></li>
                <li><a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span class="link-name">View Tournament</span>
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

           <a href="profile.php"><img src="resource/pics/profile.png" alt=""></a>
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
                        <span class="text">Total Trainings</span>
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
                        <span class="text">Total Matches</span>
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
                    <span class="text">Matches</span>
                </div>

                <div class="activity-data">
                    <table class="table black">
                        <thead>
                            <tr >
                            <th>S/N</th>
                            <th>Team A</th>
                            <th>Team A Score</th>
                            <th>Team B</th>
                            <th>Team B Score</th>
                            <th>Description</th>
                            <th>Date and time</th>
                            <th>Location</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        $gid = $_SESSION['user_id'];;
                        $selquery ="SELECT * FROM match_tbl WHERE team_a_id = $gid";
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
                                <td class="center"> <?php echo $row['team_a_id'] ?></td>
                                <td class="center"> <?php echo $row['team_a_score'] ?></td>
                                <td class="center"> <?php echo $row['team_b_id'] ?></td>
                                <td class="center"> <?php echo $row['team_b_score'] ?></td>
                                <td class="center"> <?php echo $row['description'] ?></td>
                                <td class="center"> <?php echo $row['datetime'] ?></td>
                                <td class="center"> <?php echo $row['location'] ?></td>
                                <td><a href="<?php echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td>
                            </tr>
                            <?php }
                            mysqli_free_result($resl);
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="Tournament">
                <div class="title">
                    <i class="fa fa-clock-o"></i>
                    <span class="text">My Tournament</span>
                </div>

                <div class="activity-data">
                <!-- <table class="table">
                    <thead>
                        <tr>
                        <th>S/N</th>
                        <th>Student Name</th>
                        <th>Student Number</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Profile</th>
                        <th>Gender</th>
                        <th>Remove</th>
                        </tr>
                    </thead> -->
                    <?php
                    //   $selquery ="SELECT `std_id`, `std_name`, `reg_number`, `std_email`, `std_phone`, `gender`, `std_dept`,`dept_name` 
                    //   FROM `student` INNER JOIN dept ON student.std_dept = dept_id";
                    //   //bind connection with query
                    //   $resl = mysqli_query($conn, $selquery);
                    //   //loop through the table
                    //   $j = 0;
                    //   while($row = mysqli_fetch_assoc($resl)){

                    //   $j++;
                    //   $id = $row['std_id'];
                    //   ?>       
                      <!-- <tbody> -->
                    <!-- //     <tr class="" >
                    //         <td class="center"> <?php //echo $j;?></td>
                    //         <td class="center"> <?php //echo $row['std_name'] ?></td>
                    //         <td class="center"> <?php //echo $row['reg_number'] ?></td>
                    //         <td class="center"> <?php //echo $row['std_email'] ?></td>
                    //         <td class="center"> <?php// echo $row['std_phone'] ?></td>
                    //         <td class="center"> <?php// echo $row['dept_name'] ?></td>
                    //         <td class="center"> <?php //echo $row['gender'] ?></td>
                    //         <td><a href="<?php echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td>
                    //         <td><a href="<?php echo 'delete.php?id='.$id; ?>"><span class="fa fa-trash btn btn-danger"></span></a></td>
                    //     </tr> -->
                         <?php //}
                    //     mysqli_free_result($resl);
                    //     mysqli_close($conn);
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </section>
    <script src="resource/js/script.js"></script>

    <!-- Adding Player -->
  <!-- Trigger the modal with a button -->
  <a class="" data-toggle="modal" data-target="#myModal">Add player</a>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add player</h4>
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
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <label for="gender">Gender:</label></br>
                        <label class="radio-inline">
                          <input type="radio" name="gender" value="Male"checked>Male
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="gender" value="Female">Female
                        </label>
                        <div class="form-group">
                            <label for="kname">Next of kin name:</label>
                            <input type="text" class="form-control" name="kname" required>
                        </div>
                        <div class="form-group">
                            <label for="kphone">Next of kin phone:</label>
                            <input type="text" class="form-control" name="kphone" required>
                        </div>
                        <button class="btn btn-success button-full" type="submit" name="addplayer">Add player</button>
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
  <!-- Schedule Training -->
  <div class="modal fade" id="trainingschedule" role="dialog">
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
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="datetime-local" class="form-control" name="time" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <button class="btn btn-success button-full" type="submit" name="schedule">Schedule Training</button>
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
  <!-- Create Match -->
  <div class="modal fade" id="creatematch" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Match</h4>
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
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="datetime-local" class="form-control" name="time" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="form-group">
                            <label for="challenge">Challenge:</label>
                            <select class="form-control" id="sel1" name="team">
                            <?php
                            include("includes/conn.php");
                            $gt = $_SESSION['user_game'];
                                      $team = mysqli_query($conn, "SELECT `id`, `name`, `game_type` FROM `team_tbl` WHERE `game_type`= 'Football'");
                                    while($row = mysqli_fetch_array($team)){
                                      echo '<option value='.$row["id"].'>'.$row["name"].'</option>';
                                    }
                                  mysqli_free_result($team);
                                  ?>
                            </select>
                        </div>
                        <button class="btn btn-success button-full" type="submit" name="add">Match</button>
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
</body>
</html>