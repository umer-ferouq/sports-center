<!DOCTYPE html>
<?php
// session_start();
include("includes/conn.php");
// if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
//     header("Location: login.php");
//   }
//   $id = $_SESSION['id'];
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

    <script src="resource/js/jquery.min.js"></script>
    <script src="resource/js/bootstrap.min.js"></script>
    <script src="resource/js/script.js"></script>
     
    <title>View Teams</title>
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
                <li><a href="dashboard.php">
                    <i class="fa fa-home"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="Viewteams.php">
                    <i class="fa fa-clone"></i>                    
                    <span class="link-name">Manage Teams</span>
                </a></li>
                <li><a href="dashboard.php">
                    <i class="fa fa-user-plus"></i>
                    <span class="link-name">Create Staff</span>
                </a></li>
                <li><a href="dashboard.php">
                    <i class="fa fa-users"></i>
                    <span class="link-name">New Teams</span>
                </a></li>
                <li><a href="dashboard.php">
                    <i class="fa fa-check"></i>
                    <span class="link-name">Update Lifescore</span>
                </a></li>
                <li><a href="dashboard.php">
                    <i class="fa fa-plus-square"></i>
                    <span class="link-name">Create Tournament</span>
                </a></li>
                <li><a href="dashboard.php#addsports">
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

           <a href="profile.php"><img src="resource/pics/profile.png" alt=""></a>
        </div>

        <div class="dash-content">
          <table class="table black">
                  <thead class="">
                      <tr>
                      <th>S/N</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Game type</th>
                      <th>Description</th>
                      <th>Address</th>
                      <th>Status</th>
                      </tr>
                  </thead>
                <?php

                $query ="SELECT id, name, email, phone, game_type, description, address, status FROM `team_tbl` ORDER BY id ASC";

                  //bind connection with query
                $res = mysqli_query($conn, $query);
                  //loop through the table
                $j = 0;
                while($row = mysqli_fetch_assoc($res)){
                  $j++;
                  $id = $row['id'];
                ?>        
                    <tbody>
                    <tr class="" >
                  <td class="center"> <?php echo $j;?></td>
                  <td class="center"> <?php echo $row['name'] ?></td>
                  <td class="center"> <?php echo $row['phone'] ?></td>
                  <td class="center"> <?php echo $row['email'] ?></td>
                  <td class="center"> <?php echo $row['game_type'] ?></td>
                  <td class="center"> <?php echo $row['description'] ?></td>
                  <td class="center"> <?php echo $row['address'] ?></td>
                  <td class="center"> <?php echo $row['status'] ?></td>
                  <!-- <td><a href="<?php //echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td> -->
                  <!-- <td><a href="<?php //echo 'delete.php?id='.$id; ?>"><span class="fa fa-trash btn btn-danger"></span></a></td> -->
              </tr>
              <?php }
              mysqli_free_result($res);
              mysqli_close($conn);
              ?>
            </tbody>
          </table><hr>
        
        </div>
    </section>
    
</body>
</html>