<?php
/*
    Plugin name: newplugin
    Plugin URI: https://www.google.com/
    Description: A simple wordpress customize plugin.
    Author: Prajakta Shelke
    Author URI: http://www.google.com
    Version: 1.0

    */

function dbi_add_settings_page()
{
    add_options_page(
        'Example plugin page',
        'Example Plugin Menu',
        'manage_options',
        'dbi-example-plugin',
        'dbi_render_plugin_settings_page'
    );
}
add_action('admin_menu', 'dbi_add_settings_page');


function dbi_render_plugin_settings_page()
{
?>
    <h2>Example Plugin Settings</h2>
    <form action="options.php" method="post">
        <?php
        settings_fields('dbi_example_plugin_options');
        do_settings_sections('dbi_example_plugin'); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
    </form>
<?php
}

function dbi_register_settings()
{
    register_setting(
        'dbi_example_plugin_options',
        'dbi_example_plugin_options',
        'dbi_example_plugin_options_validate'
    );
    add_settings_section('api_settings', 'API Settings', 'dbi_plugin_section_text', 'dbi_example_plugin');

    add_settings_field('dbi_plugin_setting_api_key', 'API Key', 'dbi_plugin_setting_api_key', 'dbi_example_plugin', 'api_settings');
    add_settings_field('dbi_plugin_setting_results_limit', 'Results Limit', 'dbi_plugin_setting_results_limit', 'dbi_example_plugin', 'api_settings');
    add_settings_field('dbi_plugin_setting_start_date', 'Start Date', 'dbi_plugin_setting_start_date', 'dbi_example_plugin', 'api_settings');
    add_settings_field('dbi_plugin_setting_number', 'numbers', 'dbi_plugin_setting_number', 'dbi_example_plugin', 'api_settings');
    add_settings_field('dbi_plugin_setting_menu', 'menus', 'dbi_plugin_setting_menu', 'dbi_example_plugin', 'api_settings');
}
add_action('admin_init', 'dbi_register_settings');

if (isset($_SERVER['HTTP_HOST'])) {
    function dbi_example_plugin_options_validate($input)
    {
        $newinput['api_key'] = trim($input['api_key']);
        if (!preg_match('/^[a-z0-9]{32}$/i', $newinput['api_key'])) {
            $newinput['api_key'] = '';
        }

        return $newinput;
    }
    function dbi_plugin_section_text()
    {
        echo '<p>Here you can set all the options for using the API</p>';
    }

    function dbi_plugin_setting_api_key()
    {
        $options = get_option('dbi_example_plugin_options');
        echo "<input id='dbi_plugin_setting_api_key' name='dbi_example_plugin_options[api_key]' type='text' value='" . esc_attr($options['api_key']) . "' />";
    }

    function dbi_plugin_setting_results_limit()
    {
        $options = get_option('dbi_example_plugin_options');
        echo "<input id='dbi_plugin_setting_results_limit' name='dbi_example_plugin_options[results_limit]' type='text' value='" . esc_attr($options['results_limit']) . "' />";
    }

    function dbi_plugin_setting_start_date()
    {
        $options = get_option('dbi_example_plugin_options');
        echo "<input id='dbi_plugin_setting_start_date' name='dbi_example_plugin_options[start_date]' type='text' value='" . esc_attr($options['start_date']) . "' />";
    }
    function dbi_plugin_setting_number()
    {
        $options = get_option('dbi_example_plugin_options');
        echo "<label for='dbi_plugin_setting_one'  > One </label>";
        echo "<input id='dbi_plugin_setting_one' name='dbi_example_plugin_options[numbers]' type='radio' value='" . esc_attr($options['one']) . "' />";
        echo "<label for='dbi_plugin_setting_two'  > Two </label>";
        echo "<input id='dbi_plugin_setting_two' name='dbi_example_plugin_options[numbers]' type='radio' value='" . esc_attr($options['two']) . "' />";
        echo "<label for='dbi_plugin_setting_three'  > Three </label>";
        echo "<input id='dbi_plugin_setting_three' name='dbi_example_plugin_options[numbers]' type='radio' value='" . esc_attr($options['three']) . "' />";
    }
    function dbi_plugin_setting_menu()
    {
        $options = get_option('dbi_example_plugin_options');
        echo "<label for='menu'>select your menu: </label>";
        echo "<select id='dbi_plugin_setting_menu' name='dbi_example_plugin_options[menus]' value='" . esc_attr($options['']) . "' />";
        echo "<option id='dbi_plugin_setting_post' name='dbi_example_plugin_options[menus]' value='" . esc_attr($options['post']) . "'>POST</option>";
        echo "<option id='dbi_plugin_setting_media' name='dbi_example_plugin_options[menus]' value='" . esc_attr($options['media']) . "'>MEDIA</option>";
        echo "<option id='dbi_plugin_setting_page' name='dbi_example_plugin_options[menus]' value='" . esc_attr($options['PAGE']) . "'>POST</option>";
        echo "</select>";
    }
}
?>