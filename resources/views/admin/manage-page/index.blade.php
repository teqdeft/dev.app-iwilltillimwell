@extends('admin.layouts.dashboard')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" /> -->

<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Manage Page</h3>
                    </div>
                </div>
            </div>
            <div class="quick-link-box w-100">
                <div class="row">


                    <div id="jstree">
                        <ul>
                            <?php
                            function createChildElement($obj)
                            {
                                if (empty($obj)) return;
                                $ele = '<ul>';
                                foreach ($obj as $eachObj) {
                                    $ele .= '<li onclick="getPageContent(event, `' . $eachObj->page_name . '`)">' . $eachObj->page_name . createChildElement($eachObj->dependents) . '</li>';
                                }
                                $ele .= '</ul>';
                                return $ele;
                            }
                            foreach ($allPages as $eachpage) {
                                echo '<li onclick="getPageContent(event, `' . $eachpage->page_name . '`)">' . $eachpage->page_name . createChildElement($eachpage->dependents) . '</li>';
                            }
                            ?>
                        </ul>

                    </div>
                    <div id="render_page">
                        <!-- <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        // $(function() {
        //     $('#jstree_demo_div').jstree();
        // });
        // $('#jstree_demo_div').on("changed.jstree", function(e, data) {
        //     console.log(data.selected);
        // });
        $('button').on('click', function() {
            $('#jstree').jstree(true).select_node('child_node_1');
            $('#jstree').jstree('select_node', 'child_node_1');
            $.jstree.reference('#jstree').select_node('child_node_1');
        });

        function getPageContent(e, pageName) {
            e.stopPropagation();
            $.ajax({
                method: "GET",
                url: SITE_URL + '/admin/manage-page/landing',
                success: function(res) {
                    console.log('response', res);
                    $("#render_page").html(res.data);

                    $('.editor1').each(function() {
                        CKEDITOR.replace($(this).prop('id'), {
                            allowedContent: true
                        });
                    });
                    // if (res.success) {
                    //     toastr.success(res.success);
                    //     window.location.reload();
                    // } else {
                    //     toastr.error(res.error);
                    // }
                },
            });
        }
    </script>

    <script>
        // CKEDITOR.replace('summary-ckeditor', {
        //     allowedContent: true
        // });
    </script>
    <!-- update modal  end-->
    @endsection