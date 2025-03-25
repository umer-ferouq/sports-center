<?php
$title = "";
include("includes/header.php");
include("includes/nav.php");
?>


<main class="flex-shrink-0">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Create Staff</h3>
            <form action="" method="post">
                <div class="form-group mb-1">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Full Name">
                </div>
                <div class="form-group mb-1">
                    <label for="reg_no" class="form-label mt-3">Staff Number</label>
                    <input type="text" class="form-control" id="reg_no" placeholder="eg. STFF/1052">
                </div>
                <div class="form-group mb-1">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="user@mail.com">
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="phone" class="form-control" id="email" placeholder="080-111-00-111">
                </div>
                <div class="form-group">
                    <label for="sel1">Department</label>
                    <select class="form-control" id="sel1">
                        <option>Computer Science</option>
                        <option>Maths</option>
                        <option>English</option>
                        <option>Islamic</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Role</label>
                    <select class="form-control" id="sel1">
                        <option>Admin</option>
                        <option>Hod</option>
                        <option>Staff</option>
                    </select>
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Gender</label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="radio">
                        <input type="radio" class="form-check-input" id="male" name="optradio" value="Male">Male
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="Female">Female
                    </label>
                </div>
                <button class="btn btn-primary btn-block w-100 mt-3">Create Staff</button>
            </form>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>