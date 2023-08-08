<?php
add_shortcode('data-tabel', function ($atts) {
    ob_start();
    require_once(ARSIP_YANUM_PLUGIN_DIR . 'inc/tabel-data.php');
    $atribut = shortcode_atts(array(
        'type'    => 'umum',
    ), $atts);
    $posttype    = $atribut['type'];

    ///Meta Fields
    if ($posttype == 'skck') {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'ttl' => [
                'type'  => 'text',
                'title' => 'Tempat,Tanggal Lahir'
            ],
            'pendidikan' => [
                'type'  => 'text',
                'title' => 'Pendidikan',
            ],
            'pekerjaan' => [
                'type'  => 'text',
                'title' => 'Pekerjaan',
            ],
            'no_hp' => [
                'type'  => 'text',
                'title' => 'No HP',
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'keterangan' => [
                'type'  => 'textarea',
                'title' => 'Keterangan',
            ],
        ];
    } else if ($posttype == 'nikah') {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'ttl' => [
                'type'  => 'text',
                'title' => 'Tempat,Tanggal Lahir'
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'keterangan' => [
                'type'  => 'textarea',
                'title' => 'Keterangan',
            ],
        ];
    } else if ($posttype == 'pindah_keluar') {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'ttl' => [
                'type'  => 'text',
                'title' => 'Tempat, Tanggal Lahir',
            ],
            'nokk' => [
                'type'  => 'text',
                'title' => 'No KK',
            ],
            'nik' => [
                'type'  => 'text',
                'title' => 'NIK',
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'jml_pindah' => [
                'type'  => 'text',
                'title' => 'Jumlah Pindah',
            ],
            'tujuan_pindah' => [
                'type'  => 'text',
                'title' => 'Tujuan Pindah',
            ],
            'alasan_pindah' => [
                'type'  => 'text',
                'title' => 'Alasan Pindah',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'no_hp' => [
                'type'  => 'text',
                'title' => 'No Handphone',
            ],
        ];
    } else if ($posttype == 'pindah_datang') {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'ttl' => [
                'type'  => 'text',
                'title' => 'Tempat, Tanggal Lahir',
            ],
            'nokk' => [
                'type'  => 'text',
                'title' => 'No KK',
            ],
            'nik' => [
                'type'  => 'text',
                'title' => 'NIK',
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'asal_pindah' => [
                'type'  => 'text',
                'title' => 'Asal Pindah',
            ],
            'tujuan_pindah' => [
                'type'  => 'text',
                'title' => 'Tujuan Pindah',
            ],
            'alasan_pindah' => [
                'type'  => 'text',
                'title' => 'Alasan Pindah',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'jml_pindah' => [
                'type'  => 'text',
                'title' => 'Jumlah Pindah',
            ],
        ];
    } else if ($posttype == 'kredit') {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'bank' => [
                'type'  => 'text',
                'title' => 'Nama Bank',
            ],
            'jml_pinjaman' => [
                'type'  => 'text',
                'title' => 'Jumlah Pinjaman',
            ],
            'keterangan' => [
                'type'  => 'textarea',
                'title' => 'Keterangan',
            ],
            'no_hp' => [
                'type'  => 'text',
                'title' => 'No HP',
            ],
        ];
    } else if ($posttype == 'kredit') {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'no_agenda_asal' => [
                'type'  => 'text',
                'title' => 'No Agenda',
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'kk' => [
                'type'  => 'text',
                'title' => 'KK',
            ],
            'ktp' => [
                'type'  => 'text',
                'title' => 'KTP',
            ],
        ];
    } else {
        $fields     = [
            'no_agenda' => [
                'type'  => 'text',
                'title' => 'Nomor',
            ],
            'tanggal' => [
                'type'  => 'date',
                'title' => 'Tanggal',
            ],
            'no_agenda_asal' => [
                'type'  => 'text',
                'title' => 'No Agenda'
            ],
            'post_title' => [
                'type'  => 'text',
                'title' => 'Nama',
            ],
            'pekerjaan' => [
                'type'  => 'text',
                'title' => 'Pekerjaan',
            ],
            'desa' => [
                'type'  => 'text',
                'title' => 'Desa',
            ],
            'keterangan' => [
                'type'  => 'textarea',
                'title' => 'Keterangan',
            ],
        ];
    }

    ///SUBMIT DATA
    echo isset($_POST) ? form_post_save($_POST) : '';

    ///Query Args
    $args   = [
        'post_type'         => $posttype,
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => -1,
    ];
    $querys = new WP_Query($args);

?>
    <div class="table-data-umum">

        <?php //if ($querys->have_posts()) : 
        ?>
        <div class="table-responsive">
            <table id="MytableData" class="table table-striped table-bordered" style="width:100%">
                <thead class="bg-warning text-capitalize">
                    <tr>
                        <?php foreach ($fields as $key => $field) : ?>
                            <th><?php echo $field['title']; ?></th>
                        <?php endforeach; ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($querys->have_posts()) : $querys->the_post(); ?>
                        <tr id="row-<?php echo get_the_ID(); ?>" data-id="<?php echo get_the_ID(); ?>">
                            <?php foreach ($fields as $key => $field) : ?>
                                <td>
                                    <?php
                                    $value = get_post_meta(get_the_ID(), $key, true);
                                    if ($key == 'post_title') {
                                        $value = get_the_title();
                                    }
                                    echo $value;
                                    ?>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <span class="btn btn-sm btn-success btn-show" data-bs-toggle="modal" data-bs-target="#ModalTable">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    <span class="mx-1 btn btn-sm btn-secondary btn-edit" data-bs-toggle="modal" data-bs-target="#ModalTable">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span class="btn btn-sm btn-danger btn-del" data-bs-toggle="modal" data-bs-target="#ModalTable">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </div>
                                <div class="d-none">
                                    <div class="form-show-<?php echo get_the_ID(); ?>">
                                        <?php echo list_post_data($posttype, $fields, get_the_ID()); ?>
                                    </div>
                                    <div class="form-edit-<?php echo get_the_ID(); ?>">
                                        <?php echo form_post_act(['post_type' => $posttype, 'action' => 'edit', 'id' => get_the_ID(), 'fields' => $fields]); ?>
                                    </div>
                                    <div class="form-del-<?php echo get_the_ID(); ?>">
                                        <div class="text-center">
                                            <div class="h5 fw-bold mb-3">
                                                Hapus Data ?
                                            </div>
                                            <span class="btn btn-danger btn-delete" data-bs-dismiss="modal" data-id="<?php echo get_the_ID(); ?>">
                                                Hapus
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <script>
            jQuery(function($) {
                $(document).ready(function() {
                    var dataTable = $('#MytableData').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        dom: 'Bfrtip',
                        buttons: [{
                                text: '<i class="fa fa-plus" aria-hidden="true"></i> Tambah',
                                className: 'bg-primary border-primary btn-tambah',
                                attr: {
                                    'data-bs-toggle': 'modal',
                                    'data-bs-target': '#ModalTable'
                                }
                            },
                            {
                                text: '<i class="fa fa-refresh" aria-hidden="true"></i> reload',
                                action: function(e, dt, node, config) {
                                    location.reload();
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                        ],
                        "columnDefs": [{
                            "orderable": false,
                            "targets": -1
                        }]
                    });
                    $(document).on('click', '.btn-reload', function() {
                        location.reload();
                    });
                    $(document).on('click', '.btn-tambah', function() {
                        $('#ModalTable .modal-title').html('Tambah data');
                        $('#ModalTable .modal-body').html($('.data-form-hide .form-tambah').clone());
                    });
                    $(document).on('click', '.btn-edit', function() {
                        var id = $(this).parents('tr').data('id');
                        $('#ModalTable .modal-title').html('Edit data');
                        $('#ModalTable .modal-body').html($('.form-edit-' + id).clone());
                    });
                    $(document).on('click', '.btn-show', function() {
                        var id = $(this).parents('tr').data('id');
                        $('#ModalTable .modal-title').html('Tampil data');
                        $('#ModalTable .modal-body').html($('.form-show-' + id).clone());
                    });
                    $(document).on('click', '.btn-del', function() {
                        var id = $(this).parents('tr').data('id');
                        $('#ModalTable .modal-title').html('');
                        $('#ModalTable .modal-body').html($('.form-del-' + id).clone());
                    });
                    $(document).on('click', '.btn-delete', function() {
                        var id = $(this).data('id');
                        $('#row-' + id + ' td').addClass('opacity-50');
                        $.ajax({
                            url: themepath.ajaxUrl,
                            method: "POST",
                            data: {
                                action: 'deletedatapost',
                                id: id,
                            }
                        }).done(function(result) {
                            if (result) {
                                $('#MytableData').DataTable().row($('#row-' + id)).remove().draw();
                            }
                        });
                    });
                });
            });
        </script>

        <div id="ModalTable" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-none data-form-hide">
            <div class="form-tambah">
                <?php echo form_post_act(['post_type' => $posttype, 'action' => 'add', 'fields' => $fields]); ?>
            </div>
        </div>

        <?php //endif; 
        ?>

    </div>

<?php
    // Restore original Post Data.
    wp_reset_postdata();
    return ob_get_clean();
});
?>