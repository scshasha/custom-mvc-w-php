<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Create a New Account</h3>
                </div>
                <div class="panel-body">
                    <form action="<?= $this->makeUrl("register/_register"); ?>" method="post">
                        <div class="form-group">
                            <label for="firstname-input">First name <span class="text-danger">*</span></label>
                            <input type="text" id="firstname-input" class="form-control" name="firstname" />
                        </div>
                        <div class="form-group">
                            <label for="lastname-input">Last name <span class="text-danger">*</span></label>
                            <input type="text" id="lastname-input" class="form-control" name="lastname" />
                        </div>                        
                        <div class="form-group">
                            <label for="email-input">Email <span class="text-danger">*</span></label>
                            <input type="text" id="email-input" class="form-control" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="password-input">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password-input" class="form-control" name="password" />
                        </div>
                        <div class="form-group">
                            <label for="password-repeat-input">Password (Repeat) <span class="text-danger">*</span></label>
                            <input type="password" id="password-repeat-input" class="form-control" name="password_repeat" />
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="<?= $this->makeURL("login"); ?>" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>