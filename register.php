  <!-- session_start();
     $title = "register";
     include 'includes/conn.php'; -->
     <?php
//Set error reporting level
error_reporting(E_ALL);
include 'includes/conn.php';
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

  // Validate password
  $password = trim($_POST['password']);
  if (empty($password)) {
    $errors[] = "Password is required.";
  } elseif (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
  }
  $cpassword = trim($_POST['cpassword']);
  if (empty($cpassword)) {
    $errors[] = "Password is required.";
  } elseif (strlen($cpassword) < 6) {
    $errors[] = "Password must be at least 6 characters.";
  }
  if ($password !== $cpassword) {
    $errors[] = "Password does not match.";
  }
  // Validate name
  $name = trim($_POST['name']);
  if (empty($name)) {
    $errors[] = "Name is required.";
  }

  $gametype = trim($_POST['gametype']);
  if (empty($gametype)) {
    $errors[] = "Game type is required.";
  }
  $desc = trim($_POST['desc']);
  if (empty($desc)) {
    $errors[] = "Description
     is required.";
  }
  $phone = trim($_POST['phone']);
  if (empty($phone)) {
    $errors[] = "Phone is required.";
  }

  // Validate address
  $address = trim($_POST['address']);
  if (empty($address)) {
    $errors[] = "Address is required.";
  }
  $role = "team";
  $status = "Pending";

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  // Check if email address is already in use
  $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  if ($stmt->rowCount() > 0) {
    $error[] = 'Email address is already in use';
  }

  // If no errors, proceed with registration
  if (empty($errors)) {
    // Add user to the database
    $stmt = $db->prepare("INSERT INTO team_tbl (name, phone, email, password, game_type, address, role, description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $email, $hashedPassword, $gametype, $address, $role, $desc, $status]);
    // Redirect to dashboard
    header('Location: login.php');
    exit();
  }else
  echo "<script>alert('Failed to register team');</script>";

}
?>
<?php
$title = "";
include("includes/header.php");
include("includes/nav.php");
?>
<body class="">
  <div class="container-fluid register-background">
    <div class="row">
    <h3 class="mb-0 display-6 text-center">join Pantami Sports Center</h3>
<br>
      <div class="col-md-3 mx-auto">
      <?php if (!empty($errors)): ?>
              <div class="alert alert-danger">
                  <ul>
                  <?php foreach ($errors as $error): ?>
                      <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                  </ul>
              </div>
          <?php endif; ?> 
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group mb-3">
              <label for="name">Team Name:</label>
              <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
              </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" id="address" placeholder="Team address" name="address" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="tel" class="form-control" id="phone" placeholder="080-2323-1111" name="phone" required>
              </div>
              <div class="form-group">
                <label for="Email">Email address</label>
                <input type="email" class="form-control" placeholder="info@game.com" id="user" name="email" required>
              </div>
            <div class="form-group">
              <label for="game type">Game Type:</label>
                <select class="form-control" name="gametype" required>
                  <?php
                    // include("includes/conn.php");
                        $team = mysqli_query($conn, "SELECT `name` FROM `game_tbl`");
                      while($row = mysqli_fetch_array($team)){
                        echo '<option value='.$row["name"].'>'.$row["name"].'</option>';
                      }
                    mysqli_free_result($team);
                  ?>
                <option value="basket ball">Basket Ball</option>
                </select>          
              </div>
              <div class="form-group">
                <label for="desc">Description:</label>
                <input type="text" class="form-control" id="desc" placeholder="Write something" name="desc">
                </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" class="form-control" id="Password" name="password" required>
                </div>
              <div class="form-group">
                <label for="cpwd">Confirm Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Confirm password" name="cpassword" required>
                </div>
              <div class="form-group form-check">
              </div>
              <button class="btn btn-success button-full" type="submit" name="register">Create account</button>
            </form>
                <p>By creating an account, you agree to the <a href="#">Terms of Service.</a>
                For more information about Pantami sports center's privacy practices.</p>
      </div>
    </div>

  </div>
</body>
<?php include("includes/footer.php") ?>