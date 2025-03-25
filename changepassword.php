<?php
$title = "";
include("includes/header.php");
include("includes/nav.php");
?>


<main class="flex-shrink-0">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h5 class="mb-0 display-5 text-center fw-semibold">Change Password</h5>
            <form action="" method="post">
            <div class="form-group mb-1">
      <label for="password" class="form-label mt-3">Old Password</label>
         <input type="text" class="form-control" id="opassword" placeholder="Old Password">
   </div>
   <div class="form-group mb-1">
      <label for="password" class="form-label mt-3">New Password</label>
         <input type="text" class="form-control" id="password" placeholder="New Password">
   </div>
   <div class="form-group mb-1">
      <label for="cpassword" class="form-label mt-3">Confirm Password</label>
          <input type="text" class="form-control" id="password" placeholder="Confirm Password">
   </div>
     <button class="btn btn-primary btn-block w-100 mt-3">Change Password</button>
            </form>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>