@extends('layouts.dashboard')

@section('content')

<div class="main-panel main-panel-for-modal-page">

    <div class="content-wrapper">

        <div class="row">

            <div class="col-md-12 grid-margin ">

                <div class="row">

                    <div class="col-md-12 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body moods-log-table">

                                <div class="card--white full-height log-view log-history">

                                    <div class="cust-head-center-wrap">

                                        <a href="{{ url('my-mood-feeling')}}" class="back-arrow btn  returnUserMood"></a>

                                        <span class="top-heading">Mood log</span>

                                        <h2 class="cust-heading-center">WHAT WAS YOUR MOOD?</h2>

                                    </div>

                                    



                                    <div class="feels-log-row row">

                                        <div class="feels-log-col col-sm-12 col-xs-12">

                                            <table class="table table-bordered user-table-box" id="mood-logs-table">

                                                <tbody>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



@push('scripts')

<script>
$(document).on("click", ".mood-view", function() {

	let mood_id = $(this).attr("mood-id");

	$(".modal-title").html($(this).attr("modal_title"));

    $("#moodfeelingpopup_view").modal("show");

    let formData = new FormData();

    formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

    formData.append("id", mood_id); 

    $('#content-area').html('<p>Please wait....</p>');

    $.ajax({

               method: "POST",

               url: "{{ route('mood-feeling-list-view') }}", 

               data:formData,

               processData: false, 

               contentType: false,

               success: function(response) {

                $('#content-area').html(response.data);

               },

    });
});

$(function(){


$("#mood-logs-table").DataTable({
    ordering: false,
    lengthChange: false,
    bInfo: false,
    responsive: true,
    pageLength: 10, // set your limit

    ajax: {
        url: SITE_URL + "/feels/mood-logs",
        type: "GET"
    },

    columns: [
        { data: "title" },
        { data: "date" },
        { data: "delete" },
    ],

    drawCallback: function(settings) {
        var api = this.api();
        var rows = api.rows().count();

        if (rows <= api.page.len()) {
            $(api.table().container()).find('.dataTables_paginate').hide();
        } else {
            $(api.table().container()).find('.dataTables_paginate').show();
        }
    }
});


});


</script>



<div class="modal" id="moodfeelingpopup_view">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Mood</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      </div>

      <div class="modal-body" id="content-area"></div>

      <div class="modal-footer">

        <button type="button" class="btn btn-danger btn-primary" data-bs-dismiss="modal">Close</button>

      </div>



    </div>

  </div>

</div>

@endpush

@endsection