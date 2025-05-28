<?php
// Tworzenie tabeli w bazie danych
function force_create_leads_table()
{
    global $wpdb;
    $table_name = 'dlaud_leads';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        city VARCHAR(255) NOT NULL,
        consent_1 TINYINT(1) NOT NULL,
        consent_2 TINYINT(1) NOT NULL,
        utm_source VARCHAR(255) NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    error_log("Tabela $table_name została utworzona lub istnieje.");
}
// add_action('init', 'force_create_leads_table');


// Obsługa formularza: zapis do bazy i wysyłka e-mail
function handle_lead_submission()
{
    error_log("✅ Funkcja handle_lead_submission uruchomiona!");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        error_log("❌ Nieprawidłowa metoda żądania.");
        wp_die("Nieprawidłowa metoda żądania.");
    }

    global $wpdb;
    $table_name = 'dlaud_leads';
    $data_wyslania = current_time('Y-m-d H:i:s');
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Nieznany';
    $name = isset($_POST['nm']) ? sanitize_text_field($_POST['nm']) : '';
    $email = isset($_POST['em']) ? sanitize_email($_POST['em']) : '';
    $phone = isset($_POST['pe']) ? sanitize_text_field($_POST['pe']) : '';
    $city = isset($_POST['ct']) ? sanitize_text_field($_POST['ct']) : '';
    $consent_1 = isset($_POST['zgoda_one']) ? 1 : 0;
    $consent_2 = isset($_POST['zgoda_two']) ? 1 : 0;

    $utm_source = isset($_POST['utm_source']) && !empty($_POST['utm_source'])
        ? sanitize_text_field($_POST['utm_source'])
        : 'organic';

    error_log("✅ Dane formularza: $name, $email, $phone, $city");

    if (empty($name) || empty($email) || empty($phone) || empty($city)) {
        error_log("❌ Błąd: brak wymaganych pól.");
        wp_die("Wszystkie pola są wymagane.");
    }

    $wpdb->insert($table_name, [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'city' => $city,
        'consent_1' => $consent_1,
        'consent_2' => $consent_2,
        'utm_source' => $utm_source,
        'created_at' => current_time('mysql')
    ]);

    error_log("✅ Lead zapisany do bazy!");

    $to = ["telemarketing@audika.pl", "audika@roial.pl", 'dlasluchu.to0269@zapiermail.com'];
    $subject = "Nowe zgłoszenie z formularza";
    $message = "Nowe zgłoszenie:\n\n" .
        "Imię i nazwisko: $name\n" .
        "E-mail: $email\n" .
        "Telefon: $phone\n" .
        "Miasto: $city\n" .
        "Wyrażam zgodę na kontakt telefoniczny: " . ($consent_1 ? "Tak" : "Nie") . "\n" .
        "Wyrażam zgodę na kontakt drogą mailową: " . ($consent_2 ? "Tak" : "Nie") . "\n" .
        "UTM Source: $utm_source\n" .
        "Wysłano z: $referer\n" .
        "Data i godzina wysłania: $data_wyslania";

    $headers = ["Content-Type: text/plain; charset=UTF-8", 'From: Dla Słuchu Formularz <marketing@dlasluchu.pl>'];

    if (!wp_mail($to, $subject, $message, $headers)) {
        error_log("❌ Błąd wysyłania maila.");
    } else {
        error_log("✅ E-mail wysłany poprawnie!");
    }

    error_log("✅ Przekierowanie na thank-you...");
    wp_redirect(home_url('/thx/'));
    exit;
}

add_action('admin_post_nopriv_save_lead', 'handle_lead_submission'); // Dla niezalogowanych użytkowników
add_action('admin_post_save_lead', 'handle_lead_submission'); // Dla zalogowanych użytkowników




// Utm Seter/checker
function enqueue_utm_script()
{
?>
    <script>
        function setUTMCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + "; path=/" + expires;
        }

        function getUTMCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function getUTMParams() {
            const params = new URLSearchParams(window.location.search);
            let utmSource = params.get("utm_source");

            if (utmSource) {
                setUTMCookie("utm_source", utmSource, 30); // Zapisujemy na 30 dni
            } else {
                utmSource = getUTMCookie("utm_source"); // Pobieramy z ciasteczka
            }

            if (utmSource) {
                let utmField = document.getElementById("utm_source");
                if (utmField) {
                    utmField.value = utmSource;
                }
            }
        }

        window.onload = getUTMParams;
    </script>
<?php
}
add_action('wp_footer', 'enqueue_utm_script'); // Wstawienie skryptu w stopce strony