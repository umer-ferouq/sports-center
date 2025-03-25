<?php
$title = "";
include("includes/header.php");
session_start();

// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=sports_db', 'root', '');

// Retrieve user information from the database
$stmt = $db->prepare("SELECT * FROM admin_tbl WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Handle form submission
if (isset($_POST['save']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
  // Update user information in the database
  $name = $_POST['name'];
  $phone = $_POST['phone'];
//   $email = $_POST['email'];
  $stmt = $db->prepare("UPDATE admin_tbl SET name = ?, phone = ? WHERE id = ?");
  $stmt->execute([$name, $phone, $_SESSION['user_id']]);
  // Display success message
  echo '<p>Profile updated!</p>';
}
?>
<main class="flex-shrink-0">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Profile</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group mb-1">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>"><br>
                </div>
                <div class="form-group mb-1">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" disabled><br>
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                </div>
                <div class="form-group mb-1">
                    <label for="role" class="form-label mt-3">Role: Admin</label>
                </div>
                <button type="submit" class="btn btn-primary w-50 mt-3" name="save">Save Changes</button>
                <!-- <a href="changepassword.php"><button class="btn btn-primary w-50 mt-3">Change Password</button></a> -->
            </form>
        </div>
    </div>
</main>