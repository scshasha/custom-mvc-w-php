<div class="container">
    <?php if (isset($this->user)) : ?>
        <div class="jumbotron">
            <h1>Hello, <?= $this->escapeHTML($this->user->firstname . " " . $this->user->lastname); ?>!</h1>
            <p>...</p>
            <p>
                <a class="btn btn-default btn-lg" href="<?= $this->makeURL("profile/{$this->user->id}"); ?>" role="button">Profile</a>
                <a class="btn btn-primary btn-lg" href="<?= $this->makeURL("login/logout"); ?>" role="button">Logout</a>
            </p>
        </div>
    <?php endif; ?>
</div>