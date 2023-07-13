<div class="modal fade" id="adminsignupModal" tabindex="-1" aria-labelledby="adminsignupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="adminsignupModalLabel">Register for Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/LMS/partials/handlesignup.php" method="POST">
                    <div class="mb-3">
                        <label for="adminname" class="form-label">Name</label>
                        <input type="text" class="form-control" required id="adminname" name="adminname" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="adminemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" required id="adminemail" name="adminemail" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="adminpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" required id="adminpassword" name="adminpassword">
                    </div>
                    <div class="mb-3">
                        <label for="admincpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" required id="admincpassword" name="admincpassword" >
                    </div>
                    <button type="submit" class="btn btn-success">Signup</button>
                </form>
            </div>
        </div>
    </div>
</div>