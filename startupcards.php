<?php
/**
 * @category WordPress_Plugin
 * @package Interesante
 * @author Interesante
 * @license GPL-3.0+
 * @link https://github.com/tangelollc/startup-cards-plugin
 * Plugin Name: Startup Cards
 * Plugin URI: https://startupcast.com/
 * Description: Startup Cards captures the most relevant information on startups and distributes it elegantly on a card
 * Version: 1.0.5
 * Author: Interesante
 * Author URI: https://interesante.com/
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: startup-cards
 * **********************************************************************
 * **********************************************************************
 *
 * *********************************************************************
 *               You should not edit the code below
 *               (or any code in the included files)
 *               or things might explode!
 * ***********************************************************************
 * 
 *	  Startup Cards - captures and distributes information on startups.
 *    Copyright (C) 2022, Interesante Inc.
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

// Make sure we don't expose any info if called directly

// If this file is access directly, abort!!!
defined( 'ABSPATH' ) || die( 'Unauthorized Access' );

//Action when user logs into admin panel
add_shortcode('startup_card', 'startupcards_main_frontend_function');

add_action( 'wp_enqueue_scripts', 'startupcards_register_frontend_scripts' );
add_action('admin_menu', 'startupcards_admin_setup_menu');
add_action('admin_init', 'register_startupcard_general_settings');



function startupcards_admin_setup_menu(){
    $page_title = 'Add API key';
    $capability = 'manage_options';
    $menu_title = 'Startup Cards';
    $icon_url = 'dashicons-slides';
    add_menu_page( $page_title, $menu_title, $capability, 'startup-cards', 'startupcards_main_admin_function', $icon_url );
}

function startupcards_main_admin_function(){ 
    $docs_icon__url = plugins_url('assets/images/docs-icon.png', __FILE__);
    $ticker_icon_url = plugins_url('assets/images/ticker-icon.png', __FILE__);
    $pro_icon__url = plugins_url('assets/images/pro-icon.png', __FILE__);
    ?>

        <!-- tabs -->
        <div class="startupcard-admin-container">
            <ul class="startupcard-admin-nav startupcard-admin-nav-tabs">
                <li class="startupcard-admin-active"><a href="#startupcard-admin-tab-1">Getting Started</a></li>
                <li><a href="#startupcard-admin-tab-2">Tools</a></li>
                <li><a href="#startupcard-admin-tab-3">Cards Settings</a></li>
            </ul>

            <!-- tab content -->
            <div class="startupcard-admin-tab-content">
                <!-- tab 1 -->
                <div id="#startupcard-admin-tab-1" class="startupcard-admin-tab-pane startupcard-admin-active">
                    <h2>Capabilities and Documentation</h2>
                    <p>
                        Startup cards by Interesante can show you funding rounds from startups accross latin america. The following table tells you what you need for each provider, and provides you with documentation links for how to show something using our cards.
                    </p>

                    <h3>Instructions</h3>
                    <ol>
                        <li>Sign up or log in on our <a href="https://startupcast.com" target="_blank">website</a>.</li>
                        <li>Get your API key and paste it into the API tab here.</li>
                        <li>Open our <a href="https://startupcast.com/dashboard/ticker-search" target="_blank">search tool</a> and look for the startup of your interest you will be shown an ID.</li>
                        <li>Click on the shortcode column and then paste this as a short code element on your WordPress page.</li>
                    </ol>
                </div>
            
                <!-- tab 2 -->
                <div id="#startupcard-admin-tab-2" class="startupcard-admin-tab-pane startupcard-admin-tab-two">
                    <div class="startupcard-admin-cta-cards">
                        <img
                            alt = "documentation icon"
                            src="https://ps.w.org/startup-cards/assets/images/docs-icon.png"
                            class="startupcard-admin-cta-images"
                        />
                        <h2>Docs</h2>
                        <div class="startupcard-admin-cta-content">
                            This page is an overview of the "How to" documentation and related resources.
                        </div>
                        <div>
                            <a href="https://startupcast.com/dashboard/faqs" target="_blank" class="startupcard-admin-cta">Read Docs</a>
                        </div>
                    </div>
                    <div class="startupcard-admin-cta-cards">
                        <img
                            alt = "ticker-search icon"
                            src="https://ps.w.org/startup-cards/assets/images/ticker-icon.png"
                            class="startupcard-admin-cta-images"
                        />
                        <h2>Tickers</h2>
                        <div class="startupcard-admin-cta-content">
                            On this page, you can search for organizations tickers and use them together with the shortcode to display the cards on your web pages.
                        </div>
                        <div>
                            <a href="https://startupcast.com/dashboard/ticker-search" target="_blank" class="startupcard-admin-cta">Search Tickers</a>
                        </div>
                    </div>
                    <div class="startupcard-admin-cta-cards">
                        <img
                            alt = "pro icon"
                            src="https://ps.w.org/startup-cards/assets/images/pro-icon.png"
                            class="startupcard-admin-cta-images"
                        />
                        <h2>Startupcards PRO</h2>
                        <div class="startupcard-admin-cta-content">
                            With Startupcards PRO you get a premium api key that allows you to display an unlimited number of cards on your web pages.
                        </div>
                        <div>
                            <a href="https://startupcast.com" target="_blank" class="startupcard-admin-cta">Get StartupCards PRO</a>
                        </div>
                    </div>
                </div>

                <!-- tab 3 -->
                <div id="#startupcard-admin-tab-3" class="startupcard-admin-tab-pane">
                    <form action="options.php" method="post">
                        <?php
                        settings_fields( 'startupcard_admin_plugin_options' );
                        do_settings_sections( 'startupcard_plugin' ); ?>
                        <?php submit_button($text="Save", $type="large save_api_button", "startupcard-admin-button"); ?>
                    </form>
                </div>
            </div>
        </div>
    <?php 
}

function startupcard_plugin_section_text() {
    ?>
        <p>Here you can set all the options for using the startup cards</p>
    <?php
}

function startupcard_admin_setting_api_key() {
    $options = get_option( 'startupcard_admin_plugin_options' );
    $value = isset($options["api_key"]) && !empty($options["api_key"]) ? $options["api_key"] : "";
    $value = filter_var(sanitize_key($value), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
?>
    <div class="startupcard-admin-form">
            <div class="startupcard-admin-form-wrapper">
                <div class="startupcard-admin-input-label">Key:</div>
                <input id="startupcard_admin_setting_api_key" class="startupcard-admin-input-field" name="<?php echo esc_attr('startupcard_admin_plugin_options[api_key]') ?>" defaultValue="" type="password" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" value="<?php echo esc_attr($value) ?>" />
            </div>
    </div>
<?php
}

function startupcard_admin_locale_setting(){
    $options = get_option('startupcard_admin_plugin_options');
    $value = isset($options["startupcard_locale"]) && !empty($options["startupcard_locale"]) ? $options["startupcard_locale"] : "es";
    $value = filter_var(sanitize_key($value), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
?>
    <p>Please select a language for the card labels:</p>
    <input id="startupcard_admin_es" name="<?php echo esc_attr('startupcard_admin_plugin_options[startupcard_locale]') ?>" type="radio" value="<?php $locale = filter_var(sanitize_key('es'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); echo esc_attr($locale) ?>" <?php echo esc_attr(checked( $value, "es", false )) ?> />
    <label for="startupcard_admin_es">Español <i>(default)</i></label><br>

    <input id="startupcard_admin_en" name="<?php echo esc_attr('startupcard_admin_plugin_options[startupcard_locale]') ?>" type="radio" value="<?php $locale = filter_var(sanitize_key('en'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); echo esc_attr($locale) ?>" <?php echo esc_attr(checked( $value, "en", false )) ?> />
    <label for="startupcard_admin_en">English</label><br>
<?php
}
function startupcard_admin_credit_setting() {
    $options = get_option( 'startupcard_admin_plugin_options' );
    $value = isset($options["credits"]) && !empty($options["credits"]) ? $options["credits"] : "hide";
    $value = filter_var(sanitize_key($value), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
?>
    <input id="startupcard_admin_credit_setting" name="<?php echo esc_attr('startupcard_admin_plugin_options[credits]') ?>" type="checkbox" value="<?php $credits = filter_var(sanitize_key('show'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); echo esc_attr($credits) ?>" <?php echo esc_attr(checked( $value, "show", false )) ?> />
<?php
}
function startupcard_admin_theme_setting() {
    $options = get_option( 'startupcard_admin_plugin_options' );
    $value = isset($options["theme"]) && !empty($options["theme"]) ? $options["theme"] : "light";
    $value = filter_var(sanitize_key($value), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
?>
    <input id="startupcard_admin_theme_light" name="<?php echo esc_attr('startupcard_admin_plugin_options[theme]') ?>" type="radio" value="<?php $theme = filter_var(sanitize_key('light'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); echo esc_attr($theme) ?>" <?php echo esc_attr(checked( $value, "light", false )) ?> />
    <label for="startupcard_admin_theme_light">Light Mode <i>(default)</i></label><br>

    <input id="startupcard_admin_theme_dark" name="<?php echo esc_attr('startupcard_admin_plugin_options[theme]') ?>" type="radio" value="<?php $theme = filter_var(sanitize_key('dark'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); echo esc_attr($theme) ?>" <?php echo esc_attr(checked( $value, "dark", false )) ?> />
    <label for="startupcard_admin_theme_dark">Dark Mode</label><br>
<?php
}

function register_startupcard_general_settings() { 
    register_setting( 'startupcard_admin_plugin_options', 'startupcard_admin_plugin_options' );
    add_settings_section( 'api_settings', 'Cards Settings', 'startupcard_plugin_section_text', 'startupcard_plugin' );

    add_settings_field( 'startupcard_admin_setting_api_key', 'API Key', 'startupcard_admin_setting_api_key', 'startupcard_plugin', 'api_settings' );
    add_settings_field( 'startupcard_admin_credit_setting', 'Show footer credits on cards', 'startupcard_admin_credit_setting', 'startupcard_plugin', 'api_settings' );
    add_settings_field( 'startupcard_admin_locale_setting', 'Card Locale', 'startupcard_admin_locale_setting', 'startupcard_plugin', 'api_settings' );
    add_settings_field( 'startupcard_admin_theme_setting', 'Card Theme', 'startupcard_admin_theme_setting', 'startupcard_plugin', 'api_settings' );

    wp_enqueue_style('startupcard-admin-styles', plugins_url('/startupcards-admin-styles.css', __FILE__));
    wp_enqueue_script('startupcard-admin-card-script', plugins_url('/startupcards-admin-script.js', __FILE__ ));
}

function startupcards_register_frontend_scripts(){
	wp_enqueue_style('startupcard-card-style', plugins_url('/startupcards-card-styles.css', __FILE__ ));
    wp_enqueue_script('startupcard-card-script', plugins_url('/startupcards-script.js', __FILE__ ));
}

function startupcards_main_frontend_function( $atts ){
    $card_options = get_option( 'startupcard_admin_plugin_options' );
    $show_credits = isset($card_options["credits"]) ? $card_options["credits"] : "hide";
    $theme = isset($card_options["theme"]) ? $card_options["theme"] : "light";
    $interesante_api_key = isset($card_options["api_key"]) ? $card_options["api_key"]: "" ;
    $url = sanitize_url('https://startupcast.com/api/v1/startups');
    $api_locale = isset($card_options['startupcard_locale']) ? $card_options['startupcard_locale'] : "es";

    $body = json_encode(array(
        'method' => filter_var(sanitize_text_field('GET'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
        "ticker" => filter_var(sanitize_text_field($atts['ticker']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
        "locale" => filter_var(sanitize_text_field($api_locale), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
        "api_key" => filter_var(sanitize_key($interesante_api_key), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
        "domain" => filter_var(sanitize_url($_SERVER['HTTP_HOST']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)
    ));


    $response = wp_remote_post( $url, array(
        'headers'   => [ 'Content-Type' => 'application/json' ],
        'body' => $body,
        'data-format' => 'body')
    );
    

    if(is_wp_error($response) || 200 != $response["response"]["code"]){
        $html = "";
        if($api_locale == "en"){
            $html .='<div class="startupcards-no-data-wrapper"><h2 class="startupcards-no-data">There is no Startup Card available at the moment. Check if the ticker is correct.</h2></div>';
        } else{
            $html .='<div class="startupcards-no-data-wrapper"><h2 class="startupcards-no-data">No existe una Startup Card disponible por el momento. Revisa si el ticker es correcto.</h2></div>';
        }

        return $html;
    }
 
    $results = json_decode(wp_remote_retrieve_body($response, true));
    $foundersData = $results -> data -> founders;
    $investorsList = $results -> data -> investors;
    $industriesData = $results -> data -> industries;
    $previous_funding_stages = $results -> data -> previous_funding_rounds;

    
    $t=time();
    $format_time = date("Y-m-d",$t);
    $date=date_create($format_time);
    $updated_at = date("Y-m-d", strtotime($results -> data -> updated_at));
    $diff = date_diff(date_create($updated_at), date_create($format_time));
    
    $logo_image_url = plugins_url('assets/images/interesante.png', __FILE__);
    $calendar_image_url = plugins_url('assets/images/calendar.png', __FILE__);


    $html = "";
    $html .= '
        <div class="startupcards-container">';
            if($show_credits == "show" && $theme == "dark"){
                $html .='<div class="startupcards-dark-main-withcredits">';
            } else if($show_credits == "show" && $theme != "dark"){
                $html .='<div class="startupcards-main-withcredits">';
            } else if($show_credits != "show" && $theme == "dark"){
                $html .='<div class="startupcards-dark-main">';
            } else if($show_credits != "show" && $theme != "dark") {
                $html .='<div class="startupcards-main">';
            }
           
            $html .='
                <div class="startupcards-top-container">
                    <div class="startupcards-last-updated-container">';
                        if(isset($results -> data -> updated_at)){
                                    if($diff -> days <= 31){
                                        $html .= '<div class="startupcards-indicator-green"></div>';
                                        if($theme == "dark"){
                                            $html .= '<div class="startupcards-dark-last-updated-text">';
                                        } else {
                                            $html .= '<div class="startupcards-last-updated-text">';
                                        }
                                            $html .= ''. esc_html($results -> labels -> updated_at_label) .' '. esc_html(date("M d, Y", strtotime($results -> data -> updated_at))) .'</div>';
                                                    } else if($diff -> days > 31 && $diff -> days <= 92){
                                                            $html .= '<div class="startupcards-indicator-yellow"></div>';
                                                            if($theme == "dark"){
                                                                $html .= '<div class="startupcards-dark-last-updated-text">';
                                                            } else {
                                                                $html .= '<div class="startupcards-last-updated-text">';
                                                            }
                                                        $html .= ''. esc_html($results -> labels -> updated_at_label) .' '. esc_html(date("M d, Y", strtotime($results -> data -> updated_at))) .'</div>';
                                                    } else if($diff -> days > 92){
                                                        $html .= '<div class="startupcards-indicator-red"></div>';
                                                        if($theme == "dark"){
                                                            $html .= '<div class="startupcards-dark-last-updated-text">';
                                                        } else {
                                                            $html .= '<div class="startupcards-last-updated-text">';
                                                        }
                                                    $html .= ''. esc_html($results -> labels -> updated_at_label) .' '. esc_html(date("M d, Y", strtotime($results -> data -> updated_at))) .'</div>';
                                                }
                        } else{
                            if($theme == "dark"){
                                $html .= '<div class="startupcards-dark-last-updated-text">';
                            } else {
                                $html .= '<div class="startupcards-last-updated-text">';
                            }
                            $html .= ''. esc_html($results -> labels -> no_updated_at_date_label) .'</div>';
                        }
                    $html .='
                    </div>
                    <div class="startupcards-org-details-container">
                        <img src="'. esc_url($results -> data -> logo_url) .'" class="startupcards-logo" alt = "startupcards logo" />
                        <div class="startupcards-details-sub-container">';
                            if($theme == "dark"){
                                $html .= '<div class="startupcards-dark-organization">';
                            } else {
                                $html .= '<div class="startupcards-organization">';
                            }
                        $html .='
                                '. esc_html($results -> data -> organization_name) .'
                                <img src="'. esc_url($results -> data -> flag_url) .'" class="startupcards-flag" alt="country flag" />
                            </div>';
                            
                            if(isset( $results -> data-> founded_date )){
                                if($theme == "dark"){
                                    $html .= '<div class="startupcards-dark-founded-date">';
                                } else {
                                    $html .= '<div class="startupcards-founded-date">';
                                }
                                $html .= ''. esc_html($results -> labels -> founded_date_label) .' '. esc_html(date("M d, Y", strtotime($results -> data-> founded_date))) .'</div>';
                            } else {
                                if($theme == "dark"){
                                    $html .= '<div class="startupcards-dark-founded-date">';
                                } else {
                                    $html .= '<div class="startupcards-founded-date">';
                                }
                                $html .= ''. esc_html($results -> labels -> no_founded_date_label) .'</div>';
                            }

                        $html .='
                        </div>
                    </div>
                    <div class="startupcards-industries-container">';
                            if($theme == "dark"){
                                $html .= '<div class="startupcards-dark-industries-label">';
                            } else {
                                $html .= '<div class="startupcards-industries-label">';
                            }
                    $html .='
                        '. esc_html($results -> labels -> industries_label) .'</div>
                        <div class="startupcards-industries-chips-wrapper">';
                        
                            if(isset($industriesData)){
                                foreach($industriesData as $result){
                                    $html .= '
                                    <div class="startupcard-chip">';
                                        if($theme == "dark"){
                                            $html .= '<div class="startupcards-dark-industry-chip">';
                                        } else {
                                            $html .= '<div class="startupcards-industry-chip">';
                                        }
                                            $html .= '
                                            '. esc_html($result) .'
                                        </div>
                                    </div>';    
                                }
                            } else{
                                $html .= '<div class="startupcards-no-industries">'. esc_html($results -> labels -> no_data_detected_label) .'</div>';
                            }
                        $html .='
                        </div>
                    </div>
                </div>
                <div class="startupcards-middle-container">';
                        if($theme == "dark"){
                            $html .= '
                            <div class="startupcards-dark-tab-container">
                                <button
                                    class="startupcards-dark-tab startupcards--tab startupcards-active-tab"
                                    onclick="startupcards_open_frontend_tab(event, \'startupcards-tab-1\')"
                                >
                                    '. esc_html($results -> labels -> capital_label) .'
                                </button>
                                <button
                                    class="startupcards-dark-tab startupcards--tab"
                                    onclick="startupcards_open_frontend_tab(event, \'startupcards-tab-2\')"
                                >
                                    '. esc_html($results -> labels -> people_label) .'
                                </button>
                            ';
                        } else {
                            $html .= '
                            <div class="startupcards-tab-container">
                                <button
                                    class="startupcards-light-tab startupcards--tab startupcards-active-tab"
                                    onclick="startupcards_open_frontend_tab(event, \'startupcards-tab-1\')"
                                >
                                    '. esc_html($results -> labels -> capital_label) .'
                                </button>
                                <button
                                    class="startupcards-light-tab startupcards--tab"
                                    onclick="startupcards_open_frontend_tab(event, \'startupcards-tab-2\')"
                                >
                                    '. esc_html($results -> labels -> people_label) .'
                                </button>
                            ';
                        }
                    $html .='
                    </div>

                    <!-- capital tab -->
                    <div id="startupcards-tab-1" class="startupcards-tab">
                        <div class="startupcards-total-funding-amount-container">';
                                if(isset($results -> data -> total_funding_amount -> amount) == false || $results -> data -> total_funding_amount -> amount == 0 || $results -> data -> total_funding_amount -> amount == null){
                                    if($theme == "dark"){
                                        $html .= '<div class="startupcards-dark-total-funding-amount-title">';
                                    } else {
                                        $html .= '<div class="startupcards-total-funding-amount-title">';
                                    }
                                    $html .='
                                           '. esc_html($results -> labels -> total_funding_amount_label) .'
                                        </div>
                                        <div class="startupcards-no-total-funding-amount">'. esc_html($results -> labels -> private_capital_raising_label) .'</div>
                                        <div class="startupcards-total-funding-amount-placeholder"></div>';
                                } else {
                                    if($theme == "dark"){
                                        $html .= '<div class="startupcards-dark-total-funding-amount-title">';
                                    } else {
                                        $html .= '<div class="startupcards-total-funding-amount-title">';
                                    }
                                    $html .='
                                            '. esc_html($results -> labels -> total_funding_amount_label) .' ('. esc_html($results -> data -> total_funding_amount -> currency). ')
                                        </div>
                                        <div class="startupcards-total-funding-amount-value">'. esc_html($results -> data -> total_funding_amount -> symbol) . ''. esc_html($results -> data -> total_funding_amount -> amount) . '</div>';
                                }
                        $html .='
                        </div>';

                        if(isset($results -> data -> latest_funding_round -> funding_type)){
                            if($theme == "dark"){
                                $html .= '<div class="startupcards-dark-current-stage-container">';
                            } else {
                                $html .= '<div class="startupcards-current-stage-container">';
                            }
                            $html .='
                                <div class="startupcards-current-stage">'. esc_html($results -> data -> latest_funding_round -> funding_type) .'</div>
                                <div class="startupcards-current-stage-label-date-wrapper">';
                                if($theme == "dark"){
                                    $html .= '<div class="startupcards-dark-current-stage-label">';
                                } else {
                                    $html .= '<div class="startupcards-current-stage-label">';
                                }
                                $html .='
                                    ' . esc_html($results -> labels -> current_stage_label) .'</div>';
                                if($theme == "dark"){
                                    $html .= '<div class="startupcards-dark-current-stage-date">';
                                } else {
                                    $html .= '<div class="startupcards-current-stage-date">';
                                }
                                $html .='
                                    '. esc_html(date("M, Y", strtotime($results -> data -> latest_funding_round -> announced_date))) .'</div>
                                </div>
                            </div>';
                        } else {
                            $html .='
                            <div class="startup-cards-no-current-stage-container">
                                <div class="startupcards-no-current-stage"></div>
                                <div class="startupcards-no-current-stage-label-date-wrapper">
                                    <div class="startupcards-no-current-stage-label"></div>
                                    <div class="startupcards-no-current-stage-date"></div>
                                </div>
                            </div>';
                        }

                        $html .='
                        <div class="startupcards-previous-funding-stages">
                            <!-- card -->';
                            if(isset($results -> data ->previous_funding_rounds)){
                                foreach($results -> data ->previous_funding_rounds as $stage){
                                    
                                    if($theme == "dark"){
                                        $html .= '<div class="startupcards-dark-previous-funding-stages-card">';
                                    } else {
                                        $html .= '<div class="startupcards-previous-funding-stages-card">';
                                    }
                                    $html .= '
                                        <div class="startupcards-previous-funding-stages-image-wrapper">
                                            <img
                                                alt="calendar icon"
                                                src="https://ps.w.org/startup-cards/assets/images/calendar.png"
                                                class="startupcards-previous-funding-stages-image"
                                            />
                                        </div>';
                                        if($theme == "dark"){
                                            $html .= '<div class="startupcards-dark-previous-funding-stages-funding-type">';
                                        } else {
                                            $html .= '<div class="startupcards-previous-funding-stages-funding-type">';
                                        }
                                        $html .= '
                                            '. esc_html($stage -> funding_type) .'
                                        </div>
                                        <div class="startupcards-previous-funding-stages-dot-wrapper">
                                            <div class="startupcards-previous-funding-stages-dot"></div>
                                        </div>';
                                        if($theme == "dark"){
                                            $html .= '<div class="startupcards-dark-previous-funding-stages-date">';
                                        } else {
                                            $html .= '<div class="startupcards-previous-funding-stages-date">';
                                        }
                                        $html .= '
                                        '. esc_html(date("M, Y", strtotime($stage -> announced_date))) .'</div>
                                    </div>';
                                }
                            }
                        $html .='
                        </div>
                    </div>
                    <!-- Personas tab -->';

                            if($show_credits == "show"){
                                $html .='<div id="startupcards-tab-2" class="startupcards-tab overflow-class-withcredits">';
                            } else{
                                $html .='<div id="startupcards-tab-2" class="startupcards-tab overflow-class">';
                            }
                        $html .='
                        <div class="startupcards-founders-section">';
                            if($theme == "dark"){
                                $html .= '<div class="startupcards-dark-founders-header">';
                            } else {
                                $html .= '<div class="startupcards-founders-header">';
                            }
                            $html .='
                            '. esc_html($results -> labels -> founders_label) .'</div>
                            <ol class="startupcards-founders-list">';
                                if($foundersData == null){
                                    if($theme == "dark"){
                                            $html .= '<div class="startupcards-dark-founder-name">';
                                        } else {
                                            $html .= '<div class="startupcards-founder-name">';
                                        }
                                    $html .= ''. esc_html($results -> labels -> no_data_detected_label) .'</div>';
                                } else{
                                    if($theme == "dark"){
                                        foreach($foundersData as $result){
                                            if($result == null){
                                                $html .= '';
                                            } else {
                                                $html .= '<li class="startupcards-dark-founder-name">'. esc_html($result) .'</li>';
                                            }
                                        }
                                    } else {
                                        foreach($foundersData as $result){
                                            if($result == null){
                                                $html .= '';
                                            } else {
                                                $html .= '<li class="startupcards-founder-name">'. esc_html($result) .'</li>';
                                            }
                                        }
                                    }
                                }
                            $html .='
                            </ol>
                        </div>
                        <div class="startupcards-investors-section">';
                            if($theme == "dark"){
                                $html .= '<div class="startupcards-dark-investors-header">';
                            } else {
                                $html .= '<div class="startupcards-investors-header">';
                            }
                            $html .='
                            '. esc_html($results -> labels -> investors_label) .'</div>
                            <ol class="startupcards-investors-list">';
                                if($investorsList == null){
                                        if($theme == "dark"){
                                            $html .= '<div class="startupcards-dark-investor-name">';
                                        } else {
                                            $html .= '<div class="startupcards-investor-name">';
                                        }
                                        $html .= ''. esc_html($results -> labels -> no_data_detected_label) .'</div>';
                                    } else {
                                        if($theme == "dark"){
                                            foreach($investorsList as $result){
                                                $html .= '<li class="startupcards-dark-investor-name">'. esc_html($result) .'</li>';
                                            }
                                        } else {
                                            foreach($investorsList as $result){
                                                $html .= '<li class="startupcards-investor-name">'. esc_html($result).'</li>';
                                            }
                                        }
                                    }
                            $html .='
                            </ol>
                        </div>
                    </div>
                </div>';

                 if($show_credits == "show"){
                    $html .='<div class="startupcards-bottom-container">';
                                if($theme == "dark"){
                                    $html .= '<div class="startupcards-dark-footer-card">';
                                } else {
                                    $html .= '<div class="startupcards-footer-card">';
                                }
                                $html .='
                                    <div class="startupcards-footer-left-section">
                                        <a class="startupcards-credits-link" href="https://interesante.com" target="_blank">';
                                            if($theme == "dark"){
                                                $html .= '<div class="startupcards-dark-footer-credits">'. esc_html($results -> labels -> powered_by_label) .'</div>
                                                <img
                                                    alt="interesante logo"
                                                    src="'. esc_url($results -> data -> interesante_logo_url_white) .'"
                                                    class="startupcards-footer-interesante-logo"
                                                />
                                                ';
                                            } else {
                                                $html .= '<div class="startupcards-footer-credits">'. esc_html($results -> labels -> powered_by_label) .'</div>
                                                <img
                                                    alt="interesante logo"
                                                    src="'. esc_url($results -> data -> interesante_logo_url) .'"
                                                    class="startupcards-footer-interesante-logo"
                                                />';
                                            }
                                            
                                        $html .= '</a>
                                    </div>
                                    <div class="startupcards-footer-right-section">
                                        <a class="startupcards-footer-button" href="'. esc_url($results -> data -> suggest_changes_url) .'" target="_blank">'. esc_html($results -> labels -> suggest_changes_label) .'</a>
                                    </div>
                                </div>
                            </div>';
                } else {
                    $html .='';
                }
                $html .='
            </div>
        </div>
    ';

    return $html;
}
?>