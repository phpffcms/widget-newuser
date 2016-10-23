<?php

use Ffcms\Core\Helper\HTML\Form;
use Ffcms\Core\Helper\Url;

/** @var \Apps\Model\Admin\Newuser\FormSettings $model */
/** @var \Ffcms\Core\Arch\View $this */

$this->title = __('New users');
$this->breadcrumbs = [
    Url::to('main/index') => __('Main'),
    Url::to('newcontent/index') => __('New users'),
    __('Settings')
];

?>

<h1><?= __('New users') ?></h1>
<hr />

<?php $form = new Form($model, ['class' => 'form-horizontal', 'method' => 'post']) ?>

<?= $form->start() ?>

<?= $form->field('count', 'text', ['class' => 'form-control'], __('How many new users will be displayed in block?'))?>
<?= $form->field('cache', 'text', ['class' => 'form-control'], __('Widget default cache time in seconds. Set 0 to disable caching'))?>

<?= $form->submitButton(__('Save'), ['class' => 'btn btn-primary']) ?>

<?= $form->finish() ?>
