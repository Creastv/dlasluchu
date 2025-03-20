<?php
$disable_form = get_post_meta(get_the_ID(), '_disable_form', true);
?>
<?php if (!$disable_form) { ?>
    <!-- ==================================Contact Area===================== -->
    <section id="contact-area" class="contact-area">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div id="contact" class="contact">
                        <div class="contact-title">
                            <h2>JUŻ TERAZ SKORZYSTAJ Z FORMULARZA
                                I UMÓW SIĘ NA DARMOWE BADANIE SŁUCHU <span class="line-right"></span></h2>
                            <p>Oddzwonimy w ciągu 48 godzin w celu umówienia wizyty</p>
                        </div><!-- /.contact-title -->
                        <div class="contact-form">
                            <form id="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                                method="POST" data-parsley-validate>
                                <input type="hidden" name="action" value="save_lead">
                                <input type="hidden" name="utm_source" id="utm_source">
                                <input type="hidden" name="utm_medium" id="utm_medium">
                                <input type="hidden" name="utm_campaign" id="utm_campaign">
                                <input type="hidden" name="utm_term" id="utm_term">
                                <input type="hidden" name="utm_content" id="utm_content">
                                <div class="row">
                                    <div class="col">
                                        <div class="single-form">
                                            <input name="nm" type="text" placeholder="Imię i nazwisko" required
                                                data-parsley-required-message="Proszę podać imię i nazwisko"
                                                data-parsley-trigger="change">
                                        </div><!-- /.single-form -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="row">
                                    <div class="col">
                                        <div class="single-form">
                                            <input name="em" type="email" placeholder="Adres e-mail" required
                                                data-parsley-required-message="Proszę podać adres e-mail"
                                                data-parsley-type="email"
                                                data-parsley-type-message="Proszę podać poprawny adres e-mail"
                                                data-parsley-trigger="change">
                                        </div><!-- /.single-form -->
                                    </div><!-- /.col -->
                                    <div class="col">
                                        <div class="single-form">
                                            <input name="pe" type="text" placeholder="Nr telefonu" required
                                                data-parsley-type="digits" minlength="9" maxlength="9"
                                                data-parsley-length="[9, 9]"
                                                data-parsley-required-message="Proszę podać numer telefonu"
                                                data-parsley-type-message="Proszę podać poprawny numer telefonu (tylko cyfry)"
                                                data-parsley-length-message="Wprowadź 9 cyfrowy numer telefonu"
                                                data-parsley-trigger="change">
                                        </div><!-- /.single-form -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="row">
                                    <div class="col">
                                        <div class="single-form">
                                            <input name="ct" type="text" placeholder="Miasto" required
                                                data-parsley-pattern="^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ\s]+$"
                                                data-parsley-required-message="Proszę podać miasto"
                                                data-parsley-pattern-message="Proszę podać poprawną nazwę miasta (tylko litery)"
                                                data-parsley-trigger="change">
                                        </div><!-- /.single-form -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="form-check">
                                    <input name="zgoda_one" class="form-check-input" type="checkbox" id="check1" required
                                        data-parsley-required-message="Proszę wyrazić zgodę" data-parsley-trigger="change">
                                    <label class="form-check-label" for="check1">
                                        Wyrażam zgodę na przetwarzanie moich danych osobowych przez ACS Audika Sp. z
                                        o.o. i kontakt telefoniczny oraz drogą
                                        elektroniczną na dane wskazane w formularzu w celu przedstawienia bezpłatnej
                                        oferty na badanie słuchu.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="zgoda_two" class="form-check-input" type="checkbox" id="check2" required
                                        data-parsley-required-message="Proszę wyrazić zgodę" data-parsley-trigger="change">
                                    <label name="zgoda_two" class="form-check-label" for="check2">
                                        Wyrażam zgodę na otrzymywanie od ACS Audika Sp. z o.o. treści marketingowych
                                        drogą elektroniczną i telefoniczną na dane
                                        wskazane w formularzu.
                                    </label>
                                </div>
                                <div class="contact-bttn text-center">
                                    <button type="submit" class="btn hvr-wobble btn-sm"><span>Wyślij formularz</span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/img/arrow-right-white.svg"
                                            alt="icon"></button>
                                </div><!-- /.contact-bttn -->
                            </form>
                        </div><!-- /.contact-form -->
                    </div><!-- /.contact -->
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->

    </section><!-- /.contact-area -->

<?php } ?>