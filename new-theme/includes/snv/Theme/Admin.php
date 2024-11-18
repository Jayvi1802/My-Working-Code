<?php
namespace snv\Theme;

/**
 * Admin class contains all the admin edits, ie. style, function of the backoffice
 */
class Admin
{
    public function __construct()
    {

        // admin contact page
        add_action('admin_menu', array($this, 'createExtraMenus'));

        // admin styles
        add_action('admin_enqueue_scripts', array($this, 'adminThemeStylesAndScripts'));
        add_action('login_enqueue_scripts', array($this, 'adminThemeStylesAndScripts'));
        add_action('login_enqueue_scripts', array($this, 'loginScreenLogo'));
        add_filter('login_headerurl', array($this, 'loginScreenLogoURL'));
        add_filter('login_headertitle', array($this, 'loginScreenURLTitle'));
        add_action( 'wp_dashboard_setup', array($this, 'createDashboardWidgets') );

        add_filter('admin_footer_text', array($this, 'remove_footer_admin'));
        add_action('login_footer', array($this, 'my_addition_to_login_footer'));

        return true;
    }

    // wp hack call for init
    public function theInit()
    {

    }

    public function remove_footer_admin () {
       // echo '&copy; '.date('Y').' - <a href="http://stijlenvorm.nl/" target="_blank" rel="nofollow">stijl en vorm</a>';
    }

    public function my_addition_to_login_footer() {
        // echo '<div style="text-align: center;">link to someplace</div>';
    }    

    public static function deregisterStandardWidgets()
    {
        global $wp_meta_boxes;
        // wp..
        // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
        // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        //  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
        // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // activity with user comments
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // wp news (rss)

    }

    public function createDashboardWidgets()
    {
        /*wp_add_dashboard_widget(
            'snv_wordpress_widget', // Widget slug.
            'Wordpress news',// Title.
            array($this, 'setWordpressDashboardWidget') // Display function.
            );

        wp_add_dashboard_widget(
            'snv_global_widget', // Widget slug.
            'General News',// Title.
            array($this, 'setGlobalDashboardWidget') // Display function.
            );*/
    }

    public function setWordpressDashboardWidget()
    {
        return get_template_part('includes/snv/Theme/admin/widgetSnvWordpressNews');
    }

    public function setGlobalDashboardWidget()
    {
        return get_template_part('includes/snv/Theme/admin/widgetSnvGlobalNews');
    }

    public function createExtraMenus()
    {
        // create contactinfo menu
        add_menu_page(
            'contactsettings',
            'Theme Options',
            'manage_options',
            'contact-info',
            array($this, 'settingsPage'),
            get_template_directory_uri() . '/includes/snv/Theme/admin/stijlenvorm-icon-small.png'
            );

        // create theme option sub-menu
        add_submenu_page(
            'themes.php',
            'S&V Thema opties',
            'S&V Thema opties',
            'administrator',
            'theme-options-snv',
            array($this, 'themePage')
            );

        //call register settings function
        add_action('admin_init', array($this, 'registerExtraOptions'));

        // add editor capabilities
        $editor = get_role('editor');
        $editor->add_cap('manage_options');
    }

    public function registerExtraOptions()
    {
        // register Contactinfo options
        register_setting('contact-settings-group', 'home-logo');
		register_setting('contact-settings-group', 'favicon');
        register_setting('contact-settings-group', 'email');
        register_setting('contact-settings-group', 'telephone');
        register_setting('contact-settings-group', 'address1');
		register_setting('contact-settings-group', 'address2');
		register_setting('contact-settings-group', 'address3');
		register_setting('contact-settings-group', 'city');
		register_setting('contact-settings-group', 'state');
        register_setting('contact-settings-group', 'postcode');
        register_setting('contact-settings-group', 'country');
        register_setting('contact-settings-group', 'latitude');
        register_setting('contact-settings-group', 'longitude');
		register_setting('contact-settings-group', 'google-analytics-code');
		register_setting('contact-settings-group', 'map');
		register_setting('contact-settings-group', 'inner-default-banner');
		register_setting('contact-settings-group', 'copy-rights');
		register_setting('contact-settings-group', 'extra-field1');
		register_setting('contact-settings-group', 'extra-field2');
		register_setting('contact-settings-group', 'extra-field3');
		register_setting('contact-settings-group', 'extra-field4');
		register_setting('contact-settings-group', 'extra-field5');
		register_setting('contact-settings-group', 'extra-field6');
		register_setting('contact-settings-group', 'extra-field7');
		register_setting('contact-settings-group', 'extra-field8');
		register_setting('contact-settings-group', 'extra-field9');
		register_setting('contact-settings-group', 'extra-field10');


        $socialChannels = explode(',', SOCIAL_MEDIA_OPTIONS);
        foreach ($socialChannels as $channel) {
            register_setting('contact-settings-group', $channel);
        }

        //register ThemeOptions
        register_setting('theme-settings-group', 'jquery');
        register_setting('theme-settings-group', 'bootstrap_js');
        register_setting('theme-settings-group', 'bootstrap_css');
        register_setting('theme-settings-group', 'wow_js');
        register_setting('theme-settings-group', 'animate_css');
        register_setting('theme-settings-group', 'font_awesome');
        register_setting('theme-settings-group', 'smoothscroll_js');
        register_setting('theme-settings-group', 'stellar_js');

        // opt-oput options 
        register_setting('theme-settings-group', 'header_titles');

        // maps settings
        register_setting('theme-settings-group', 'googlemapsjson');
        register_setting('theme-settings-group', 'googleAPIkey');

        if(get_option('googleAPIkey') === false ) {
            update_option('googleAPIkey', htmlspecialchars('AIzaSyAiUL5mg2P798TtcoYuQP3vfd6iaAU2-44') );
        }

        do_action('registerChildOptions');
    }

    public function settingsPage()
    {
        return include 'admin/contactpage.php';
    }

    public function themePage()
    {
        return include 'admin/themepage.php';
    }

    // add css to login/admin pages
    public function adminThemeStylesAndScripts()
    {
        //wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.admin.min.css', array());
        wp_enqueue_style('my-admin-theme', get_template_directory_uri() . '/includes/snv/Theme/admin/style.css');
        wp_enqueue_script('my-admin-script', get_template_directory_uri() . '/includes/snv/Theme/admin/script.js', array('jquery'), '1.0', true);

        // for the contactonfo page
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }

    // change login screen
    public function loginScreenLogo()
    {
        ?>
        <?php $logo_url = get_template_directory_uri() . '/includes/snv/Theme/admin/logo-login.png';?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo $logo_url;?>);
                padding-bottom: 0px;
                padding: 0;
                width: 274px;
                background-size: 100% auto;
            }
        </style>
        <?php
    }

    public function loginScreenLogoURL()
    {
        return '/';
    }

    public function loginScreenURLTitle()
    {
        return '';
    }
}
