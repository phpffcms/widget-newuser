# Widget Newuser
This widget allow you to display new users in website template block on ffcms 3. **Demo**:

![Widget new users preview image](https://cloud.githubusercontent.com/assets/3446897/19624709/f78f7170-990b-11e6-8d37-275b67f00596.png)

To use this widget you should require it by composer:

```
composer require phpffcms/widget-newuser:1.*@stable
```

or insert in composer.json to section "require": {}

```
"require": {
  "phpffcms/widget-newuser": "1.*@stable"
}
```

Then in ffcms admin panel follow to *Widgets* -> *All widgets* ... -> press *Install* and type in field ``Newuser`` and push **Try install**.

After installation is complete you can use anywhere in front templates (ex. in /Apps/Views/Front/default/layout/main.php) block like this:
```
<?php if (Widgets\Front\Newuser\Newuser::enabled()): ?>
    <div class="panel panel-primary">
        <div class="panel-heading"><?= __('New users') ?></div>
        <div class="panel-body">
            <?= Widgets\Front\Newuser\Newuser::widget(); ?>
        </div>
    </div>
<?php endif; ?>
```
