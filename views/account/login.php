<?php
include($_SERVER['DOCUMENT_ROOT'].'/controllers/users.php');
require __DIR__ .'/../header/header.php';

?>
<div class="container-fluid" style="padding-top: 10px;">
    <div class="row">
        <div class="col-xs-12 col-md-6" style="background-color: yellow">
            <h1 style="text-align: center; padding:50% 0;">Welcome to Date Night</h1>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="container-fluid">
                <form action="/controllers/users.php" method="post">
                    <input type="hidden" name="login_user">
                    <div class="form-group">
                        <label for="username">Username or Email Address</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username or Email Address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary" name="Submit">
                </form>
            </div>
            <div class="join container" style="padding: .5rem; margin:5% 0; background-color: green; text-align:center; letter-spacing: .1em!important;">
                <h2>Join DateNight</h2>
            </div>
            <div class="container" style="background-color: #EDEBE9;">
                <a class="btn btn-primary" href="/views/account/register.php">JOIN NOW</a>
                <h3>Create an account and save our ideas for your next date! </h3>
            </div>
        </div>
    </div>
</div>
    <!-- Optional JavaScript -->
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>