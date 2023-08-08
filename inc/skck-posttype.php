<?php
// Register post type function
add_action('init', 'skck_post_type');
function skck_post_type()
{
    register_post_type('skck', array(
        'labels' => array(
            'name' => 'SKCK',
            'singular_name' => 'skck',
        ),
        'menu_icon' => 'dashicons-database-view',
        'menu_position' => 5,
        'public' => true,
        'has_archive' => true,
        // 'taxonomies' => array('skck'),
        'supports' => array(
            'title',
        ),
    ));
}

// function ak_add_skck()
// {
//     register_taxonomy(
//         'kategori-skck',
//         'skck',
//         array(
//             'label' => __('Kategori SKCK'),
//             'rewrite' => array('slug' => 'kategori-skck'),
//             'hierarchical' => true,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'show_in_nav_menus' => true,
//         )
//     );
// }


add_filter('rwmb_meta_boxes', 'skck_register_meta_boxes');
function skck_register_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title'      => esc_html__('Detail Agenda', 'kadican'),
        'id'         => 'details',
        'post_types' => 'skck',
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
                'name' => esc_html__('Pekerjaan', 'kadican'),
                'id'   => 'pekerjaan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Pendidikan', 'kadican'),
                'id'   => 'pendidikan',
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
            [
                'type' => 'text',
                'name' => esc_html__('No. HP', 'kadican'),
                'id'   => 'no_hp',
            ],
        ],
    );
    return $meta_boxes;
}

// [form-skck]
add_shortcode('form-skck', 'form_skck');
function form_skck()
{
    ob_start();
    global $post;
    $args = array(
        'post_type' => 'skck',
        'posts_per_page'    => -1,
    );
    $query = new WP_Query($args);
    // print_r($_SESSION) . '<br/>';
    if (isset($_POST['no_agenda'])) {
        $post_id = wp_insert_post(array(
            'post_type' => 'skck',
            'post_title' => $_POST['nama'],
            'post_status' => 'publish',
            'comment_status' => 'closed',   // if you prefer
            'meta_input' => array(
                'no_agenda' => $_POST['no_agenda'],
                'tanggal' => $_POST['tanggal'],
                'nama' => $_POST['nama'],
                'ttl' => $_POST['ttl'],
                'pendidikan' => $_POST['pendidikan'],
                'desa' => $_POST['desa'],
                'keterangan' => $_POST['keterangan'],
                'no_hp' => $_POST['no_hp'],
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
            <label for="ttl">Tempat, Tanggal Lahir</label>
            <input class="form-control" type="text" name="ttl" placeholder="Tempat, Tanggal Lahir" required />
        </div>
        <div class="form-group mb-3">
            <label for="pekerjaan">Pekerjaan</label>
            <input class="form-control" type="text" name="pekerjaan" placeholder="Pekerjaan" required />
        </div>
        <div class="form-group mb-3">
            <label for="pendidikan">Pendidikan</label>
            <input class="form-control" type="text" name="pendidikan" placeholder="Pendidikan" required />
        </div>
        <div class="form-group mb-3">
            <label for="desa">Desa</label>
            <input class="form-control" type="text" name="desa" placeholder="Desa" required />
        </div>
        <div class="form-group mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" type="text" name="keterangan" placeholder="Keterangan" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input class="form-control" type="text" name="no_hp" placeholder="No HP" required>
        </div>
        <button type="submit" id="btnKirim" class="btn btn-primary mb-2 w-100">Kirim</button>
    </form>
<?php
    return ob_get_clean();
}
