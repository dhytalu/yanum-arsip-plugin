<?php
// Register post type function
add_action('init', 'kredit_post_type');
function kredit_post_type()
{
    register_post_type('kredit', array(
        'labels' => array(
            'name' => 'Kredit',
            'singular_name' => 'kredit',
        ),
        'menu_icon' => 'dashicons-database-view',
        'menu_position' => 5,
        'public' => true,
        'has_archive' => true,
        // 'taxonomies' => array('kredit'),
        'supports' => array(
            'title',
        ),
    ));
}

// function ak_add_kredit()
// {
//     register_taxonomy(
//         'kategori-kredit',
//         'kredit',
//         array(
//             'label' => __('Kategori Kredit'),
//             'rewrite' => array('slug' => 'kategori-kredit'),
//             'hierarchical' => true,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'show_in_nav_menus' => true,
//         )
//     );
// }


add_filter('rwmb_meta_boxes', 'kredit_register_meta_boxes');
function kredit_register_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title'      => esc_html__('Detail Agenda', 'kadican'),
        'id'         => 'details',
        'post_types' => 'kredit',
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
                'name' => esc_html__('Desa', 'kadican'),
                'id'   => 'desa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nama Bank', 'kadican'),
                'id'   => 'bank',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Jumlah Pinjaman', 'kadican'),
                'id'   => 'jml_pinjaman',
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

// [form-kredit]
add_shortcode('form-kredit', 'form_kredit');
function form_kredit()
{
    ob_start();
    global $post;
    $args = array(
        'post_type' => 'kredit',
        'posts_per_page'    => -1,
    );
    $query = new WP_Query($args);
    // print_r($_SESSION) . '<br/>';
    if (isset($_POST['no_agenda'])) {
        $post_id = wp_insert_post(array(
            'post_type' => 'kredit',
            'post_title' => $_POST['nama'],
            'post_status' => 'publish',
            'comment_status' => 'closed',   // if you prefer
            'meta_input' => array(
                'no_agenda' => $_POST['no_agenda'],
                'tanggal' => $_POST['tanggal'],
                'nama' => $_POST['nama'],
                'desa' => $_POST['desa'],
                'bank' => $_POST['bank'],
                'jml_pinjaman' => $_POST['jml_pinjaman'],
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
            <label for="desa">Desa</label>
            <input class="form-control" type="text" name="desa" placeholder="Desa" required />
        </div>
        <div class="form-group mb-3">
            <label for="bank">Nama Bank</label>
            <input class="form-control" type="text" name="bank" placeholder="Nama Bank" required />
        </div>
        <div class="form-group mb-3">
            <label for="jml_pinjaman">Jumlah Pinjaman</label>
            <input class="form-control" type="text" name="jml_pinjaman" placeholder="Jumlah Pinjaman" required />
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
