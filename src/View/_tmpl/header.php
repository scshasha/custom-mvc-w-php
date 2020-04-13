<?php

use App\Utility\Config;
use App\Utility\Flash;
?>
<!DOCTYPE html>
<html lang="en-EU">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="">
        <title><?= sprintf("%s · %s", $this->escapeHTML($this->title), $this->escapeHTML(APP_NAME)); ?></title>
        <!-- Bootstrap CSS -->
<!--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
<!--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--        <link rel="stylesheet" href="http://squard.io/assets/css/main.css">-->
        <link rel="stylesheet" type="text/css" href="<?= $this->makeURL("assets/lib/bootstrap/css/bootstrap-4.4.1.min.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $this->makeURL("assets/lib/font-awesome/css/font-awesome-4.7.0.min.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?= $this->makeURL("assets/css/main.css"); ?>" />
        <?= $this->getCSS(); ?>
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-expand-lg d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-0 bg-light navbar-light border-bottom shadow-sm">
                <a href="<?= $this->makeURL(); ?>" class="navbar-brand mr-4"><?= $this->escapeHTML(APP_NAME) ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->makeURL("post"); ?>">Latest Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->makeURL("about"); ?>">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->makeURL("contascascasact"); ?>">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-md-auto">
                        <!--                    <li class="nav-item active">-->
                        <!--                        <a class="nav-link p-2" href="#">Home <span class="sr-only">(current)</span></a>-->
                        <!--                    </li>-->
                        <!--                    <li class="nav-item">-->
                        <!--                        <a class="nav-link p-2" href="#">About</a>-->
                        <!--                    </li>-->
                        <!--                    <li class="nav-item">-->
                        <!--                        <a class="nav-link p-2" href="#">Contact</a>-->
                        <!--                    </li>-->
                        <?php if (property_exists($this, 'user')) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-item nav-link dropdown-toggle mr-md-2  p-2" href="#" id="bd-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-user-circle mr-1"></span>Howdy, <?= $this->user->firstname; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="bd-profile">
                                    <a class="dropdown-item" href="<?= $this->makeURL("profile/{$this->user->id}"); ?>"><span class="fa fa-user mr-1"></span>View Profile</a>
                                    <a class="dropdown-item" href="<?= $this->makeURL("profile/edit/{$this->user->id}"); ?>"><span class="fa fa-edit mr-1"></span>Edit Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <?php if (property_exists($this->user, 'user_role')) : ?>

                                        <?php if ($this->user->user_role === "ADMIN") : ?>
                                        <a class="dropdown-item" href="<?= $this->makeURL("dashboard"); ?>"><span class="fa fa-gear mr-1"></span>Settings</a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                    <a class="dropdown-item" href="<?= $this->makeURL("login/logout"); ?>"><span class="fa fa-sign-out mr-1"></span>Sign out</a>
                                </div>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>

            </nav>
            <!-- /#navbar -->
            <div id="container">
                <div id="header"></div>
                <!-- /#header -->
                <div id="content">
                    <div id="feedback" class="container">

                        <?php if ($danger = Flash::danger()) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oh no!</strong> <?= $this->escapeHTML($danger); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ($warning = Flash::warning()) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Erm...</strong> <?= $this->escapeHTML($warning); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ($success = Flash::success()) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Awesome!</strong> <?= $this->escapeHTML($success); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ($info = Flash::info()) : ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Heads up!</strong> <?= $this->escapeHTML($info); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ($errors = Flash::session(Config::get("SESSION_ERRORS"))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oh no!</strong> Please verify that the fields below are correct.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul>
<!--                                    <pre>-->
                                    <?php //var_dump($errors); ?>
<!--                                    </pre>-->
                                    <?php foreach ($errors as $key => $values) : ?>
                                        <?php $values = array_unique($values); ?>
                                        <?php foreach ($values as $value) : ?>
                                            <li><?= $this->escapeHTML($value); ?></li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- /#feeedback -->
