<?php
/** @var \Illuminate\Database\Eloquent\Collection $records */

if ($records->count() < 1) {
    echo __('No users found');
    return;
}
?>

<div class="row">
<?php foreach ($records as $profile): ?>
    <?php /** @var \Apps\ActiveRecord\Profile $profile */ ?>
    <div class="col-md-6">
        <a href="<?= \Ffcms\Core\Helper\Url::to('profile/show', $profile->user_id) ?>" class="thumbnail text-center">
            <span><?= $profile->getNickname() ?></span><br />
            <img src="<?= $profile->getAvatarUrl('small') ?>" alt="Profile avatar: <?= $profile->getNickname() ?>" style="height: 65px;width: 65px;"/>
            <span class="label label-info"><?= \Ffcms\Core\Helper\Date::convertToDatetime($profile->created_at, 'd.m.Y') ?></span>
        </a>
    </div>
<?php endforeach; ?>
</div>
<div class="row">
    <div class="col-md-12">
        <?= \Ffcms\Core\Helper\Url::link(['profile/index', 'all'], __('Show all users')) ?>
    </div>
</div>
