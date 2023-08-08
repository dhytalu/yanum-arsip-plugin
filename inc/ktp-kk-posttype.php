<?php
// Register post type function
add_action('init', 'ktp_kk_post_type');
function ktp_kk_post_type()
{
    register_post_type('ktp_kk', array(
        'labels' => array(
            'name' => 'KTP & KK',
            'singular_name' => 'ktp_kk',
        ),
        'menu_icon' => 'dashicons-database-view',
        'menu_position' => 5,
        'public' => true,
        'has_archive' => true,
        // 'taxonomies' => array('ktp_kk'),
        'supports' => array(
            'title',
        ),
    ));
}

// add_action('init', 'ak_add_ktp_kk');
// function ak_add_ktp_kk()
// {
//     register_taxonomy(
//         'kategori-skck',
//         'skck',
//         array(
//             'label' => __('Kategori KTP & KK'),
//             'rewrite' => array('slug' => 'kategori-ktp_kk'),
//             'hierarchical' => true,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'show_in_nav_menus' => true,
//         )
//     );
// }


add_filter('rwmb_meta_boxes', 'ktp_kk_register_meta_boxes');
function ktp_kk_register_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title'      => esc_html__('Detail Agenda', 'kadican'),
        'id'         => 'details',
        'post_types' => 'ktp_kk',
        'context'    => 'side',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('No. Agenda', 'kadican'),
                'id'   => 'no_agenda',
                'desc'  => 'Auto Generate'
            ],
            [
                'type' => 'date',
                'name' => esc_html__('Tanggal', 'kadican'),
                'id'   => 'date',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('No. Agenda', 'kadican'),
                'id'   => 'no_agenda_asal',
                'desc'  => 'Dari asal surat'
            ],
            /*[
                'type' => 'text',
                'name' => esc_html__('Nama', 'kadican'),
                'id'   => 'nama',
            ],*/
            [
                'type' => 'text',
                'name' => esc_html__('Desa', 'kadican'),
                'id'   => 'desa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('KK', 'kadican'),
                'id'   => 'kk',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('KTP', 'kadican'),
                'id'   => 'ktp',
            ],
        ],
    );
    return $meta_boxes;
}

// [form-ktp_kk]
add_shortcode('form-ktp_kk', 'form_ktp_kk');
function form_ktp_kk()
{
    ob_start();
    global $post;
    $args = array(
        'post_type' => 'ktp_kk',
        'posts_per_page'    => -1,
    );
    $query = new WP_Query($args);
    // print_r($_SESSION) . '<br/>';
    if (isset($_POST['no_agenda'])) {
        $post_id = wp_insert_post(array(
            'post_type' => 'ktp_kk',
            'post_title' => $_POST['nama'],
            'post_status' => 'publish',
            'comment_status' => 'closed',   // if you prefer
            'meta_input' => array(
                'no_agenda' => $_POST['no_agenda'],
                'tanggal' => $_POST['tanggal'],
                'no_agenda_asal' => $_POST['no_agenda_asal'],
                'nama' => $_POST['nama'],
                'desa' => $_POST['desa'],
                'kk' => $_POST['kk'],
                'ktp' => $_POST['ktp'],
            ),
        ));

        echo '<div class="bg-success p-2 text-success bg-opacity-25"><b>Selamat, data anda berhasil di input!</b></div>';
    }
?>
    <form id="msform" name="msform" action="" method="POST">
        <div class="form-group mb-3">
            <label for="no_agenda">Nomor</label>
            <input class="form-control" type="text" name="no_agenda" placeholder="Nomor" required />
        </div>
        <div class="form-group mb-3">
            <label for="tanggal">Tanggal</label>
            <input class="form-control" type="date" name="tanggal" placeholder="Tanggal" required />
        </div>
        <div class="form-group mb-3">
            <label for="no_agenda_asal">No Agenda</label>
            <input class="form-control" type="text" name="no_agenda_asal" placeholder="No Agenda" required />
        </div>
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input class="form-control" type="text" name="nama" placeholder="Nama" required />
        </div>
        <div class="form-group mb-3">
            <label for="desa">Desa</label>
            <input class="form-control" type="text" name="desa" placeholder="Desa" required />
        </div>
        <div class="form-group mb-3">
            <label for="kk">KK</label>
            <input class="form-control" type="text" name="kk" placeholder="KK" required />
        </div>
        <div class="form-group mb-3">
            <label for="ktp">KTP</label>
            <input class="form-control" type="text" name="ktp" placeholder="KTP" required />
        </div>
        <button type="submit" id="btnKirim" class="btn btn-primary mb-2 w-100">Kirim</button>
    </form>
<?php
    return ob_get_clean();
}
