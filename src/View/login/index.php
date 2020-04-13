<div class="container">
    <div class="row mt-md-5 mt-lg-5">

        <div class="col-md-offset-6 col-md-6">
            <!-- <h1 style="font-size: 10rem;color: #4267b2"> -->
                <?php //$this->escapeHTML(APP_NAME)?>
            <!-- </h1> -->
            <div>
                <!-- <p>Facebook helps you connect and share with the people in your life.</p> -->
                <h2><?=ucfirst(strtolower($this->escapeHTML(APP_NAME)))?> helps you connect and share moments with people with alike interests.</h2>
            </div>
            <img class="img" src="https://static.xx.fbcdn.net/rsrc.php/v3/yi/r/OBaVg52wtTZ.png" alt="" width="537" height="195">
        </div>    
        <div class="col-md-offset-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <!-- <h3 class="panel-title text-center">Account Login</h3> -->
                </div>
                <div class="panel-body">
                    <form action="<?= $this->makeUrl("login/_login"); ?>" method="post">
                        <div class="form-group">
                            <label for="email-input">Email <span class="text-danger">*</span></label>
                            <input type="text" id="email-input" class="form-control" name="email" required="true" placeholder="mail@mail.com" />
                        </div>
                        <div class="form-group">
                            <label for="password-input">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password-input" class="form-control" name="password" placeholder="password" required="true" />
                        </div>
                        <div class="checkbox">
                            <label for="remember">
                                <input type="checkbox" id="remember" name="remember" /> Remember me
                            </label>

                            <a href="<?= $this->makeURL("password-reset"); ?>" class="btn btn-link pull-right p-0">Forgotten account?</a>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                            <a href="<?= $this->makeURL("register"); ?>" class="btn btn-link">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>