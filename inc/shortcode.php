<?php
// date time 
add_shortcode('date-now', 'date_now');
function date_now()
{
    return date("d F Y");
}

// [vd-profile]
add_shortcode('vd-profile', 'vd_profile');
function vd_profile($atts)
{
    ob_start();
    $atribut = shortcode_atts(array(
        'text-login'    => 'Profil',
        'text-logout'   => 'Masuk',
    ), $atts);

    $text = is_user_logged_in() ? $atribut['text-login'] : $atribut['text-logout'];
    $link = is_user_logged_in() ? get_home_url() . '/user' : get_home_url() . '/login';

    echo '<a class="velocitymp-profil" href="' . $link . '">';
    echo '<i class="fa fa-user-circle"></i>';
    echo '<span class="ml-1 d-none d-md-inline-block">' . $text . '</span>';
    echo '</a>';

    return ob_get_clean();
}

// [count-post post_type="umum"]
add_shortcode('count-post', 'count_post');
function count_post($atts)
{
    ob_start();
    $today =  date('Y-m-d');
    global $post;
    $atribut = shortcode_atts(array(
        'post_type'    => 'umum',
    ), $atts);

    $posttype    = $atribut['post_type'];
    $args = [
        'post_type' => [$posttype],
        'post_status' => 'publish',
        'date_query' => [
            'after' => 'today',
            'inclusive'         => true,
        ],
    ];
    $querys = new WP_Query($args);
    echo $querys->found_posts;;
    return ob_get_clean();
}

add_action('wp_footer', 'modalTambahData');
function modalTambahData()
{
?>
    <div class="modal fade" id="modalDataFooter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
<?php
}

add_action('wp_footer', 'modalViewData');
function modalViewData()
{
?>
    <div class="modal fade" id="modalViewData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
<?php
}
