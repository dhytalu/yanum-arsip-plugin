<?php
// Register post type function
add_action('init', 'pindah_datang_post_type');
function pindah_datang_post_type()
{
    register_post_type('pindah_datang', array(
        'labels' => array(
            'name' => 'Pindah Datang',
            'singular_name' => 'pindah_datang',
        ),
        'menu_icon' => 'dashicons-database-view',
        'menu_position' => 5,
        'public' => true,
        'has_archive' => true,
        // 'taxonomies' => array('pindah_datang'),
        'supports' => array(
            'title',
        ),
    ));
}

// add_action('init', 'ak_add_pindah_datang');
// function ak_add_pindah_datang()
// {
//     register_taxonomy(
//         'kategori-pindah_datang',
//         'pindah_datang',
//         array(
//             'label' => __('Kategori Pindah Datang'),
//             'rewrite' => array('slug' => 'kategori-pindah_datang'),
//             'hierarchical' => true,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'show_in_nav_menus' => true,
//         )
//     );
// }


add_filter('rwmb_meta_boxes', 'pindah_datang_register_meta_boxes');
function pindah_datang_register_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title'      => esc_html__('Detail Agenda', 'kadican'),
        'id'         => 'details',
        'post_types' => 'pindah_datang',
        'context'    => 'side',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('No. Agenda', 'kadican'),
                'id'   => 'no_agenda',
                'desc'  => 'Auto Generate'
            ],
            /*[
                'type' => 'text',
                'name' => esc_html__('Nama', 'kadican'),
                'id'   => 'nama',
            ],*/
            [
                'type' => 'text',
                'name' => esc_html__('Tempat, Tanggal Lahir', 'kadican'),
                'id'   => 'ttl',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('No KK', 'kadican'),
                'id'   => 'nokk',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NIK', 'kadican'),
                'id'   => 'nik',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Desa', 'kadican'),
                'id'   => 'desa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Asal Pindah', 'kadican'),
                'id'   => 'asal_pindah',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Tujuan Pindah', 'kadican'),
                'id'   => 'tujuan_pindah',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Alasan Pindah', 'kadican'),
                'id'   => 'alasan',
            ],
            [
                'type' => 'date',
                'name' => esc_html__('Tanggal', 'kadican'),
                'id'   => 'date',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Jumlah Pindah', 'kadican'),
                'id'   => 'jml_pindah',
            ],
        ],
    );
    return $meta_boxes;
}

// [form-pindah_datang]
add_shortcode('form-pindah_datang', 'form_pindah_datang');
function form_pindah_datang()
{
    ob_start();
    global $post;
    $args = array(
        'post_type' => 'pindah_datang',
        'posts_per_page'    => -1,
    );
    $query = new WP_Query($args);
    // print_r($_SESSION) . '<br/>';
    if (isset($_POST['no_agenda'])) {
        $post_id = wp_insert_post(array(
            'post_type' => 'pindah_datang',
            'post_title' => $_POST['nama'],
            'post_status' => 'publish',
            'comment_status' => 'closed',   // if you prefer
            'meta_input' => array(
                'no_agenda' => $_POST['no_agenda'],
                'nama' => $_POST['nama'],
                'ttl' => $_POST['ttl'],
                'nokk' => $_POST['nokk'],
                'nik' => $_POST['nik'],
                'asal_pindah' => $_POST['asal_pindah'],
                'tujuan_pindah' => $_POST['tujuan_pindah'],
                'alasan' => $_POST['alasan'],
                'tanggal' => $_POST['tanggal'],
                'jml_pindah' => $_POST['jml_pindah'],
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
            <label for="nama">Nama</label>
            <input class="form-control" type="text" name="nama" placeholder="Nama" required />
        </div>
        <div class="form-group mb-3">
            <label for="ttl">Tempat, Tgl Lahir</label>
            <input class="form-control" type="text" name="ttl" placeholder="Tempat, Tgl Lahir" required />
        </div>
        <div class="form-group mb-3">
            <label for="nokk">No. KK</label>
            <input class="form-control" type="text" name="nokk" placeholder="No. KK" required />
        </div>
        <div class="form-group mb-3">
            <label for="nik">NIK</label>
            <input class="form-control" type="text" name="nik" placeholder="NIK" required />
        </div>
        <div class="form-group mb-3">
            <label for="asal_pindah">Asal Pindah</label>
            <input class="form-control" type="text" name="asal_pindah" placeholder="Asal Pindah" required />
        </div>
        <div class="form-group mb-3">
            <label for="tujuan_pindah">Tujuan Pindah</label>
            <input class="form-control" type="text" name="tujuan_pindah" placeholder="Tujuan Pindah" required />
        </div>
        <div class="form-group mb-3">
            <label for="alasan">Alasan Pindah</label>
            <input class="form-control" type="text" name="alasan" placeholder="Alasan Pindah" required />
        </div>
        <div class="form-group mb-3">
            <label for="tanggal">Tanggal</label>
            <input class="form-control" type="date" name="tanggal" placeholder="Tanggal" required />
        </div>
        <div class="form-group mb-3">
            <label for="jml_pindah">Jumlah</label>
            <textarea class="form-control" type="text" name="jml_pindah" placeholder="Jumlah" required></textarea>
        </div>
        <button type="submit" id="btnKirim" class="btn btn-primary mb-2 w-100">Kirim</button>
    </form>
<?php
    return ob_get_clean();
}
