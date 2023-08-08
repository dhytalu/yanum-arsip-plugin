<?php
function form_post_act($args)
{
    //session
    if (empty($_SESSION["form_session"])) {
        $_SESSION["form_session"] =  uniqid();
    }

    $post_type  = $args['post_type'];
    $action     = $args['action'] ? $args['action'] : 'add';
    $fields     = $args['fields'];
    $id         = $args['id'] ? $args['id'] : '';

    echo '<form class="form_post_act" action="" method="post">';

    foreach ($fields as $key => $field) :
        $value = $id ? get_post_meta($id, $key, true) : '';
        if ($key == 'post_title' && $id) {
            $value = get_the_title();
        }
        echo '<div class="mb-3">';
        echo '<label for="' . $key . '">' . $field['title'] . '</label>';

        $attr = [
            'class="form-control"',
            'name="' . $key . '"',
            'value="' . $value . '"',
            'placeholder="' . $field['title'] . '"',
            'required',
        ];

        switch ($field['type']) {
            case "date":
                echo '<input type="date" ' . implode(" ", $attr) . '>';
                break;
            case "textarea":
                echo '<textarea ' . implode(" ", $attr) . '>' . $value . '</textarea>';
                break;
            default:
                echo '<input type="text" ' . implode(" ", $attr) . '>';
        }

        echo '</div>';
    endforeach;

    echo '<input type="hidden" name="post_id" value="' . $id . '">';
    echo '<input type="hidden" name="posttype" value="' . $post_type . '">';
    echo '<input type="hidden" name="action" value="' . $action . '">';
    echo '<input type="hidden" name="form_session" value="' . $_SESSION["form_session"] . '">';
    echo '<div class="text-end">';
    echo '<button type="submit" class="btn btn-success btn-submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>';
    echo '</div>';
    echo '</form>';
}


function form_post_save($post)
{
    if (empty($post))
        return false;

    if ($post["form_session"] == $_SESSION["form_session"]) {

        $postdata = [
            'post_title'    => $post['post_title'],
            'post_type'     => $post['posttype'],
            'post_status'   => 'publish',
        ];

        if ($post['action'] == 'edit') {
            $postdata['ID'] = $post['post_id'];
        }

        unset($post['post_title']);
        unset($post['form_session']);
        unset($post['action']);
        unset($post['posttype']);
        unset($post['post_id']);

        $postdata['meta_input'] = $post;

        if ($post['action'] == 'edit') {
            wp_update_post($postdata);
        } else {
            wp_insert_post($postdata);
        }

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo 'Data Berhasil disimpan';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';

        //reset session
        $_SESSION["form_session"] =  uniqid();
    }
}


function list_post_data($post_type, $fields, $id)
{
    echo '<table class="table">';
    foreach ($fields as $key => $field) :
        $value = $id ? get_post_meta($id, $key, true) : '';
        if ($key == 'post_title' && $id) {
            $value = get_the_title();
        }
        echo '<tr>';
        echo '<td>' . $field['title'] . '</td>';
        echo '<td>' . $value . '</td>';
        echo '</tr>';
    endforeach;
    echo '</table>';
}
