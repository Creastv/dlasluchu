<?php
// function display_leads_page()
// {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'leads';
//     $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

//     echo '<div class="wrap"><h1>Leady</h1>';

//     // Link do eksportu CSV
//     $export_url = admin_url('admin-post.php?action=export_leads_csv');
//     echo '<a href="' . esc_url($export_url) . '" class="button button-primary">Eksportuj CSV</a>';

//     echo '<table class="widefat fixed">';
//     echo '<thead><tr><th>ID</th><th>Imię i nazwisko</th><th>E-mail</th><th>Telefon</th><th>Miasto</th><th>UTM_Source</th><th>Zgoda 1</th><th>Zgoda 2</th><th>Data</th></tr></thead>';
//     echo '<tbody>';
//     foreach ($results as $row) {
//         echo "<tr>
//             <td>{$row->id}</td>
//             <td>{$row->name}</td>
//             <td>{$row->email}</td>
//             <td>{$row->phone}</td>
//             <td>{$row->city}</td>
//             <td>{$row->utm_source}</td>
//             <td>" . ($row->consent_1 ? "Tak" : "Nie") . "</td>
//             <td>" . ($row->consent_2 ? "Tak" : "Nie") . "</td>
//             <td>{$row->created_at}</td>
//         </tr>";
//     }
//     echo '</tbody></table></div>';
// }
function display_leads_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'leads';

    // Pobieranie parametrów GET dla filtrowania
    $start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : '';
    $end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : '';
    $order = isset($_GET['order']) && $_GET['order'] === 'asc' ? 'ASC' : 'DESC';
    $next_order = $order === 'ASC' ? 'desc' : 'asc';

    // Budowanie warunku SQL dla filtrowania
    $where_clause = "1=1";
    if (!empty($start_date)) {
        $where_clause .= " AND created_at >= '$start_date'";
    }
    if (!empty($end_date)) {
        $where_clause .= " AND created_at <= '$end_date'";
    }

    // Pobieranie leadów z uwzględnieniem filtracji
    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE $where_clause ORDER BY created_at $order", ARRAY_A);

    echo '<div class="wrap"><h1>Leady</h1>';

    // Formularz do filtrowania
    echo '<form method="GET" action="">';
    echo '<input type="hidden" name="page" value="leads">';
    echo 'Data od: <input type="date" name="start_date" value="' . esc_attr($start_date) . '"> ';
    echo 'Data do: <input type="date" name="end_date" value="' . esc_attr($end_date) . '"> ';
    submit_button('Filtruj', 'primary', '', false);
    echo '</form><br>';

    // Link do eksportu CSV z aktualnym filtrem
    $export_url = admin_url('admin-post.php?action=export_leads_csv') . "&start_date=$start_date&end_date=$end_date";
    echo '<a href="' . esc_url($export_url) . '" class="button button-primary">Eksportuj wyniki do CSV</a><br><br>';

    // Pobieranie aktualnego URL i dodanie parametru sortowania
    $sort_url = esc_url(add_query_arg(['order' => $next_order]));

    echo '<table class="widefat fixed">';
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Imię i nazwisko</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <th>Miasto</th>
                <th>UTM_Source</th>
                <th>Zgoda 1</th>
                <th>Zgoda 2</th>
                <th><a href="' . $sort_url . '">Data</a></th>
            </tr>
          </thead>';
    echo '<tbody>';
    foreach ($results as $row) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['city']}</td>
            <td>{$row['utm_source']}</td>
            <td>" . ($row['consent_1'] ? "Tak" : "Nie") . "</td>
            <td>" . ($row['consent_2'] ? "Tak" : "Nie") . "</td>
            <td>{$row['created_at']}</td>
        </tr>";
    }
    echo '</tbody></table></div>';
}



function add_leads_menu_page()
{
    add_menu_page(
        'Leady',
        'Leady',
        'manage_options',
        'leads',
        'display_leads_page', // Nazwa funkcji wywoływanej do wyświetlenia strony
        'dashicons-groups',
        25
    );
}
add_action('admin_menu', 'add_leads_menu_page');

function export_leads_to_csv()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'leads';

    // Pobieranie parametrów GET dla filtrowania
    $start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : '';
    $end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : '';

    // Budowanie warunku SQL dla filtrowania
    $where_clause = "1=1";
    if (!empty($start_date)) {
        $where_clause .= " AND created_at >= '$start_date'";
    }
    if (!empty($end_date)) {
        $where_clause .= " AND created_at <= '$end_date'";
    }

    // Pobranie leadów zgodnych z filtrem
    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE $where_clause ORDER BY created_at DESC", ARRAY_A);

    if (!$results) {
        wp_die('Brak danych do eksportu.');
    }

    // Pobranie aktualnej daty w formacie YYYY-MM-DD
    $current_date = date('Y-m-d');
    $filename = "leady_{$current_date}.csv";

    // Ustawienie nagłówków HTTP do pobrania pliku
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    // Nagłówki kolumn
    fputcsv($output, ['ID', 'Imię i nazwisko', 'E-mail', 'Telefon', 'Miasto', 'UTM_Source', 'Zgoda 1', 'Zgoda 2', 'Data']);

    // Dodanie wierszy do CSV
    foreach ($results as $row) {
        fputcsv($output, [
            $row['id'],
            $row['name'],
            $row['email'],
            $row['phone'],
            $row['city'],
            $row['utm_source'],
            $row['consent_1'] ? 'Tak' : 'Nie',
            $row['consent_2'] ? 'Tak' : 'Nie',
            $row['created_at']
        ]);
    }

    fclose($output);
    exit;
}


add_action('admin_post_export_leads_csv', 'export_leads_to_csv');
