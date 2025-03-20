</main>
<?php get_template_part('templates-parts/parts/contact-form'); ?>
<!-- ==================================Footer Area===================== -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-112">
                <div class="footer-inner">
                    <div class="footer-left">
                        <a href="<?php echo esc_url(home_url('/')); ?>"><img
                                src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/logo-white.svg"
                                alt="logo"></a>
                    </div><!-- /.footer-left -->
                    <div class="footer-right">
                        <?php
                        wp_nav_menu([
                            'menu' => 'footer',
                            'container' => 'nav',
                            'container_class' => "footer-menu"
                        ]);
                        ?>
                        <p>&copy; 2025 Copyrights audika.pl made by <a href="#">roial.pl</a></p>
                    </div><!-- /.footer-right -->
                </div><!-- /.footer-inner -->
            </div><!-- /.col-112 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /.footer-area -->
<?php wp_footer(); ?>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('consent', 'default', {
        'ad_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied',
        'analytics_storage': 'denied'
    });
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=GTM-5TRSZNKF"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'GTM-5TRSZNKF');
</script>


<script type="text/javascript" src="//www.termsfeed.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8">
</script>
<script type="text/javascript" charset="UTF-8">
    document.addEventListener('DOMContentLoaded', function() {
        cookieconsent.run({
            "notice_banner_type": "simple",
            "consent_type": "express",
            "palette": "light",
            "language": "pl",
            "page_load_consent_levels": ["strictly-necessary", 'functionality'],
            "notice_banner_reject_button_hide": true,
            "preferences_center_close_button_hide": false,
            "page_refresh_confirmation_buttons": false,
            "website_privacy_policy_url": "https://www.audika.pl/polityka-prywatnosci",
            "website_name": "Audika",
            "callbacks": {
                "scripts_specific_loaded": (level) => {
                    switch (level) {
                        // case 'targeting':
                        // // case 'tracking':
                        //   gtag('consent', 'update', {
                        //     'ad_storage': 'granted',
                        //     'ad_user_data': 'granted',
                        //     'ad_personalization': 'granted',
                        //     'analytics_storage': 'granted'
                        //   });
                        // break;
                        case 'targeting':
                            gtag('consent', 'update', {
                                'ad_storage': 'granted',
                                'ad_user_data': 'granted',
                                'ad_personalization': 'granted',
                                // 'analytics_storage': 'denied'
                            });
                            break;
                        case 'tracking':
                            gtag('consent', 'update', {
                                // 'ad_storage': 'denied',
                                // 'ad_user_data': 'denied',
                                // 'ad_personalization': 'denied',
                                'analytics_storage': 'granted'
                            });
                            break;

                    }
                }
            },
            "callbacks_force": true
        });
    });

    setTimeout(() => {
        const save = document.querySelector('.cc-nb-changep');
        if (save) {
            save.addEventListener('click', function() {
                saveForm();
            });
        }
    }, "100");

    setTimeout(() => {
        const saveAll = document.querySelector('.cc-nb-okagree');
        if (saveAll) {
            saveAll.addEventListener('click', function() {
                console.log('checked all');
                gtag('consent', 'update', {
                    'ad_storage': 'granted',
                    'ad_user_data': 'granted',
                    'ad_personalization': 'granted',
                    'analytics_storage': 'granted'
                });
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    'event': 'consent_update'
                });
            });
        }
    }, "100");

    const open = document.querySelector('#open_preferences_center')
    open.addEventListener('click', function(e) {
        e.preventDefault();
        setTimeout(() => {
            saveFormAfter();
        }, "1");
    });

    const update = function() {
        const checkboxTracking = document.querySelector('.cc-custom-checkbox#tracking');
        const checkboxTargeting = document.querySelector('.cc-custom-checkbox#targeting');

        if (checkboxTracking.checked) {
            console.log('checked tracking');
            gtag('consent', 'update', {
                'analytics_storage': 'granted'
            });
        } else {
            console.log('unchecked tracking');
            gtag('consent', 'update', {
                'analytics_storage': 'denied'
            });
        }
        if (checkboxTargeting.checked) {
            console.log('checked targeting');
            gtag('consent', 'update', {
                'ad_storage': 'granted',
                'ad_user_data': 'granted',
                'ad_personalization': 'granted',
            });
        } else {
            console.log('unchecked targeting');
            gtag('consent', 'update', {
                'ad_storage': 'denied',
                'ad_user_data': 'denied',
                'ad_personalization': 'denied',
            });
        }
    }

    const saveForm = function() {
        setTimeout(() => {
            const button = document.querySelector('.cc-cp-foot-save');
            button.addEventListener('click', function() {
                update();
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    'event': 'consent_update'
                });
            });
        }, "100");
    }

    const saveFormAfter = function() {
        setTimeout(() => {
            const button = document.querySelector('.cc-cp-foot-save');
            button.addEventListener('click', function() {
                update();
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    'event': 'consent_update'
                });
                // location.reload();
            });
        }, "100");
    }
</script>
</body>

</html>