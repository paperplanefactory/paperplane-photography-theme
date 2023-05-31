<?php
function set_theme_github_data()
{
    $screen = get_current_screen();
    if ((strpos($screen->id, 'theme-general-settings') == true) || (strpos($screen->id, 'acf-options-archives') == true) || (strpos($screen->id, 'acf-options-color-typo-options') == true) || (strpos($screen->id, 'acf-options-image-gallery-options') == true)) {
        $them_info = wp_get_theme();
        $theme_version = esc_html($them_info->get('Version'));
        $theme_url = esc_html($them_info->get('ThemeURI'));
        $theme_text_domain = esc_html($them_info->get('TextDomain'));
        //var_dump($them_info);
        //die();
        // generate manifest
        $update_data = array(
            'version' => $theme_version,
            'details_url' => $theme_url . '/archive/refs/tags/' . $theme_version . '.zip',
            'download_url' => $theme_url . '/archive/refs/tags/' . $theme_version . '.zip'
        );
        // encode manifest data
        $update_data = stripslashes(json_encode($update_data));
        // set path to manifest.json file
        $file = '/plugin-update-checker/examples/theme.json';
        // write/overwrite manifest.json on site root folder
        file_put_contents(__DIR__ . $file, $update_data);
    }
}

add_action('acf/save_post', 'set_theme_github_data', 20);