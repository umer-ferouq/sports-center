<?php
$title = "";
include("includes/header.php");
include("includes/nav.php");
?>


<main class="flex-shrink-0">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Edit Profile</h3>
            <form action="" method="post">
                <div class="form-group mb-1">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Full Name" disabled>
                </div>
                <div class="form-group mb-1">
                    <label for="reg_no" class="form-label mt-3">Reg Number</label>
                    <input type="text" class="form-control" id="reg_no" placeholder="eg. UG17/SCCS/1052" disabled>
                </div>
                <div class="form-group mb-1">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="user@mail.com">
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="phone" class="form-control" id="email" placeholder="080-111-00-111">
                </div>
                <div class="form-group mb-1">
                    <label for="password" class="form-label mt-1">Faculty</label>
                    <input type="text" class="form-control" value="Faculty" disabled>
                <div class="form-group mb-1">
                    <label for="cpassword" class="form-label mt-3">Department</label>
                    <input type="text" class="form-control" value="Computer Science" disabled>
                </div>
                <a href="editprofile.php"><button class="btn btn-primary w-50 mt-3">Save</button></a>
            </form>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>