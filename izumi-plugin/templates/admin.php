<div class="wrap">
    <h1>Izumi Plugin</h1>
    <?php settings_errors();?>
    <form method="post" action="options.php">
        <?php
            settings_fields('izumi_options_group');
            do_settings_sections('izumi_plugin');
            submit_button();
        ?>
    </form>
</div>