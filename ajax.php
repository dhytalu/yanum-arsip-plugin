<?php
add_action('wp_ajax_tabeldataumum', 'tabeldataumum_ajax');
function tabeldataumum_ajax()
{
    $result = [];
    $args   = [
        'post_type'         => 'umum',
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => -1,
    ];
    $querys = new WP_Query($args);
    if ($querys->have_posts()) :
        while ($querys->have_posts()) : $querys->the_post();
            $result['data'][] = [
                "id"            => get_the_ID(),
                "noagenda"      => get_post_meta(get_the_ID(), 'no_agenda', true),
                "nama"          => get_the_title(),
                "desa"          => get_post_meta(get_the_ID(), 'desa', true),
                "keterangan"    => get_post_meta(get_the_ID(), 'keterangan', true),
            ];
        endwhile;
    endif;

    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_deletedatapost', 'deletedatapost_ajax');
function deletedatapost_ajax()
{
    $post_id = isset($_POST['id']) ? $_POST['id'] : '';
    wp_delete_post($post_id);
    echo $post_id;
}
