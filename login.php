<?php
$title = "login";
include("includes/header.php");
include("includes/nav.php");

session_start();
// Set error reporting level
error_reporting(E_ALL);

// Initialize error messages array
$errors = array();

// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=sports_db', 'root', '');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate email
  $email = trim($_POST['email']);
  if (empty($email)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  $role = trim($_POST['user']);

  // Validate password
  $password = trim($_POST['password']);
  if (empty($password)) {
    $errors[] = "Password is required.";
//   } elseif (strlen($password) < 6) {
//     $errors[] = "Password must be at least 6 characters.";
  }

  // If no errors, check login credentials
  if (empty($errors) && $role == "admin") {
    // Check if user exists
      $stmt = $db->prepare("SELECT * FROM admin_tbl WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
    // if ($user OR password_verify($password, $user['password'])) {

      // Set session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_role'] = $user['role'];

      // Redirect to appropriate dashboard based on role
      if ($_SESSION['user_role'] == 'Admin') {
        header('Location: dashboard.php');
      } 
      else {
        header('Location: logout.php');
      }
      exit();
    } else {
      $errors[] = "Invalid email or password.";
      // echo $password;
      //echo $user['password'];
    }
  }
  elseif (empty($errors) && $role == "team") {
    // Check if user exists
    $stmt = $db->prepare("SELECT * FROM team_tbl WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    // if ($user && password_verify($password, $user['password'])) {
    if ($user OR password_verify($password, $user['password'])) {

      // Set session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_role'] = $user['role'];
      $_SESSION['user_game'] = $user['game_type'];

      // Redirect to appropriate dashboard based on role
      if ($_SESSION['user_role'] == 'team') {
        header('Location: teamdashboard.php');
      } 
      else {
        header('Location: logout.php');
      }
      exit();
    } else {
      $errors[] = "Invalid email or password.";
    }
  }
  elseif (empty($errors) && $role == "player") {
    // Check if user exists
    $stmt = $db->prepare("SELECT * FROM player_tbl WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    // if ($user && password_verify($password, $user['password'])) {
    if ($user OR password_verify($password, $user['password'])) {

      // Set session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_role'] = $user['role'];
      $_SESSION['team'] = $user['team_id'];

      // Redirect to appropriate dashboard based on role
      if ($_SESSION['user_role'] == 'Player') {
        header('Location: playerdashboard.php');
      } 
      else {
        header('Location: logout.php');
      }
      exit();
    } else {
      $errors[] = "Invalid email or password.";
   
    }
  }
}
?>

<main class="flex-shrink-0 login-background">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Login</h3>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                </div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group mb-3">
                    <label for="email" class="form-label mt-4">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="eg. Me@sport.com">
                </div>
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="password" class="form-label">Password</label>
                        <a href="" class="text-muted">Forgot password?</a>
                    </div>
                    <input type="text" class="form-control" id="password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                <label for="sel1">Role</label>
                    <select class="form-control" id="sel1" name="user">
                        <option value="admin">Admin</option>
                        <option value="team">Team</option>
                        <option value="player">Player</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-success btn-block w-100" name="submit">Login</button>
            </form>
            <p class="d-block text-center mt-3">Don't have an account <a href="register.php">Register</a></p>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>