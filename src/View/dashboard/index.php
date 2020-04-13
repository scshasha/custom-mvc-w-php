<div class="container">
    <?php if (isset($this->user)) : ?>
        <div class="jumbotron">
            <h1><?= $this->escapeHTML($this->title); ?></h1>
            <p>...</p>
            <p>
                <a class="btn btn-default btn-lg" href="<?= $this->makeURL("profile/{$this->user->id}"); ?>" role="button">Profile</a>
                <a class="btn btn-primary btn-lg" href="<?= $this->makeURL("login/logout"); ?>" role="button">Logout</a>
            </p>
        </div>
    <?php endif; ?>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($this->members)): ?>
                    <?php foreach($this->members as $member): ?>    
                        <?php $member = (object) $member; ?>    
                        <tr>
                            <td><?= $member->firstname; ?></td>
                            <td><?= $member->lastname; ?></td>
                            <td><?= $member->email; ?></td>
                            <td><?= $member->gender; ?></td>
                            
                            <td>
                            <!-- <a href="" class="btn"></a> -->
                                <a href="<?= $this->makeURL("profile/{$member->id}"); ?>" class="btn btn-sm btn-primary btn-group-sm"><span class="fa fa-user mr-1"></span>Profile</a>&nbsp;
                                <a href="<?= $this->makeURL("profile/edit/{$member->id}"); ?>" class="btn btn-sm btn-warning btn-group-sm"><span class="fa fa-edit mr-1"></span>Manage</a>&nbsp;
                                <a href="<?= $this->makeURL("profile/remove/{$member->id}"); ?>" class="btn btn-sm btn-group-sm btn-danger"><span class="fa fa-remove mr-1"></span>Remove</a>&nbsp;
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>   
    </div>
</div>