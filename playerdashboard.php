<!DOCTYPE html>
<?php
// session_start();
// include('config/config.php');

// if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
//     header("Location: login.php");
//   }
//   $id = $_SESSION['id'];
include("includes/conn.php");

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
                <li><a href="adddept.php">
                    <i class="fa fa-users"></i>                    
                    <span class="link-name">Matches</span>
                </a></li>
                <li><a href="viewstaff.php">
                    <i class="fa fa-cubes"></i>
                    <span class="link-name">Trainings</span>
                </a></li>
                <li><a href="posting.php">
                    <i class="fa fa-sitemap"></i>
                    <span class="link-name">Tournament</span>
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

           <a href="pprofile.php"><img src="resource/pics/profile.png" alt=""></a>
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
            <!-- start of match -->
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
                        $gid = $_SESSION['team'];;
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
            <!-- end of match activity -->

            <!-- Start of Training -->
            <div class="activity">
                <div class="title">
                    <i class="fa fa-clock-o"></i>
                    <span class="text">Training</span>
                </div>

                <div class="activity-data">
                <table class="table">
       
                </div>
            </div>
            <!-- end of Training -->
            <div class="Tournament">
                <div class="title">
                    <i class="fa fa-clock-o"></i>
                    <span class="text">Tournament</span>
                </div>

                <div class="activity-data">
                
                </div>
            </div>
        </div>
    </section>
    <script src="resource/js/script.js"></script>
</body>
</html>