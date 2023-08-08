<?php
// Register post type function
add_action('init', 'nikah_post_type');
function nikah_post_type()
{
    register_post_type('nikah', array(
        'labels' => array(
            'name' => 'Nikah',
            'singular_name' => 'nikah',
        ),
        'menu_icon' => 'dashicons-database-view',
        'menu_position' => 5,
        'public' => true,
        'has_archive' => true,
        // 'taxonomies' => array('nikah'),
        'supports' => array(
            'title',
        ),
    ));
}

// add_action('init', 'ak_add_nikah');
// function ak_add_nikah()
// {
//     register_taxonomy(
//         'kategori-nikah',
//         'nikah',
//         array(
//             'label' => __('Kategori Nikah'),
//             'rewrite' => array('slug' => 'kategori-nikah'),
//             'hierarchical' => true,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'show_in_nav_menus' => true,
//         )
//     );
// }


add_filter('rwmb_meta_boxes', 'nikah_register_meta_boxes');
function nikah_register_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title'      => esc_html__('Detail Agenda', 'kadican'),
        'id'         => 'details',
        'post_types' => 'nikah',
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
                'name' => esc_html__('Desa', 'kadican'),
                'id'   => 'desa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Keterangan', 'kadican'),
                'id'   => 'keterangan',
            ],
        ],
    );
    return $meta_boxes;
}

// [form-nikah]
add_shortcode('form-nikah', 'form_nikah');
function form_nikah()
{
    ob_start();
    global $post;
    $args = array(
        'post_type' => 'nikah',
        'posts_per_page'    => -1,
    );
    $query = new WP_Query($args);
    // print_r($_SESSION) . '<br/>';
    if (isset($_POST['no_agenda'])) {
        $post_id = wp_insert_post(array(
            'post_type' => 'nikah',
            'post_title' => $_POST['nama'],
            'post_status' => 'publish',
            'comment_status' => 'closed',   // if you prefer
            'meta_input' => array(
                'no_agenda' => $_POST['no_agenda'],
                'tanggal' => $_POST['tanggal'],
                'nama' => $_POST['nama'],
                'ttl' => $_POST['ttl'],
                'alamat' => $_POST['alamat'],
                'keterangan' => $_POST['keterangan'],
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
            <label for="nama">Nama</label>
            <input class="form-control" type="text" name="nama" placeholder="Nama" required />
        </div>
        <div class="form-group mb-3">
            <label for="pekerjaan">Pekerjaan</label>
            <input class="form-control" type="text" name="pekerjaan" placeholder="Pekerjaan" required />
        </div>
        <div class="form-group mb-3">
            <label for="ttl">Tempat, Tanggal Lahir</label>
            <input class="form-control" type="text" name="ttl" placeholder="Tempat, Tanggal Lahir" required />
        </div>
        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input class="form-control" type="text" name="alamat" placeholder="Alamat" required />
        </div>
        <div class="form-group mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" type="text" name="keterangan" placeholder="Keterangan" required></textarea>
        </div>
        <button type="submit" id="btnKirim" class="btn btn-primary mb-2 w-100">Kirim</button>
    </form>
<?php
    return ob_get_clean();
}
