@extends('layouts.v1.dashboard')
@section('content')


    <div class="content-wrapper">
	    <div class="row">
        <div class="col-md-12 grid-margin top-header-page">
            <div class="row">
                <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold mb-2">Journal</h3>
                    <h6 class="font-weight-normal mb-0">Home / <span><a href="javascript:void(0);">Journal</a></span>
                    </h6>
                </div>
				
            </div>
        </div>
    </div>
	
        <div class="rowa">
            <div class="">
                <div class="row1">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
									
							<div class="search-journal">
								<div class="form-group">
									<input type="text" class="form-control" name="searchInput" id="searchInput" placeholder="Search">
								</div>
							</div>
							
<section class="journal-new-main journal-logs-response">


   

    <div class="journal-card-row ">	
		@if($data->count())	
			@foreach ($data as $journal)
				<div class="journal-log carc-col journal-parent-div-{{$journal['id']}}">
					<div class="journal-card-new">
					
						<div class="edit-trash">
							<div class="date">
								<p>{{ \Carbon\Carbon::parse($journal['created_at'])->format('m/d/Y') }}</p>
							</div>
							<div class="trash" >
								<a href="javascript:;" number="{{$journal['id']}}" class="deleteByAjax" data-url="{{ url('view-journal-log-post-deleted')}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
							</div>
						</div>
						<div class="title">
							<p>{{$journal['title']}}</p>
						</div>
						<div class="text text-description">
							{!! $journal['description'] !!}
						</div>
						<div class="cta journal-read-more">
							<a onclick="journalreadmore({{$journal['id']}})" href="javascript:void(0)" class="open-modal" data-modal="MyJournalModal">Read More ...</a>
						</div>
					</div>
				</div>
			@endforeach
		@else 
			<div class="journal-log carc-col journal-no-record-found">
				<p>No Record</p>
			</div>
		@endif	
	
    </div>
</section>

<div class="jorurnal-degail-pagination">
	{{ $data->links() }}
</div>

	
								
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

<!-- Modal 1 -->
<div id="MyJournalModal" class="custom-modal journal-record-modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>

        <div class="modeal-detail">
            <div class="date">
                <p>05/08/2025</p>
            </div>
            <div class="title">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam tempora voluptate sint assumenda,
                    placeat aliquid sequi amet similique nihil, perspiciatis alias nam praesentium labore laudantium est
                    commodi aspernatur iste vero.</p>
            </div>
            <div class="text">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, at. Distinctio, illum veniam
                    praesentium obcaecati voluptatem officia beatae quas enim ab vero. Quia quo, necessitatibus vitae
                    velit fugit dolor sed. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ab mollitia
                    veniam quam, labore dolore excepturi quasi eius accusamus id possimus facilis cumque dolorum.
                    Pariatur possimus consectetur et non corrupti! Lorem ipsum, dolor sit amet consectetur adipisicing
                    elit. Voluptate odit cum mollitia animi veniam autem officiis vitae. Voluptatem aperiam vero culpa.
                    Dolore fugit at, voluptatem cum ut voluptatibus facere excepturi.
                </p>
            </div>
        </div>

    </div>
</div>	

<script>
    const openModalButtons = document.querySelectorAll('.open-modal');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    const modals = document.querySelectorAll('.custom-modal');

    openModalButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const modalId = button.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
            }
        });
    });

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.custom-modal');
            modal.style.display = 'none';
        });
    });

    window.addEventListener('click', (e) => {
        modals.forEach(modal => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
	
/* $(document).on('click', '.journal-read-more', function() {
	
	let titleHtml = $(this).closest('.journal-parent-div').find('.+""').html();
	console.log(titleHtml);
	
});	 */
function journalreadmore(id){
	
	let date = $(".journal-parent-div-"+id+" .date p").html();
	let title = $(".journal-parent-div-"+id+" .title p").html();
	let title_description = $(".journal-parent-div-"+id+" .text-description").html();
	
	$("#MyJournalModal .date").html(date);
	$("#MyJournalModal .title").html(title);
	$("#MyJournalModal .text").html(title_description);
	
}
</script>

@push('scripts')

<script>
$(document).ready(function () { 
    $("#searchInput").on("keyup", function () {
		var searchText = $(this).val().toLowerCase();
		var matchCount = 0;
         
        $(".journal-log").each(function () {
			
			var titleText = $(this).find(".title p").text().toLowerCase();
            var dateText = $(this).find(".date p").text().toLowerCase();
            var descText = $(this).find(".text-description").text().toLowerCase();
			
            if (titleText.includes(searchText) || dateText.includes(searchText) || descText.includes(searchText)) {
                $(this).show();
				matchCount++;
            } else {
                $(this).hide();
            }
			console.log(matchCount);
			if (matchCount === 0) {
				if ($("#noResults").length === 0) {
					$(".journal-logs-response").append('<div id="noResults" style="position: relative;border: 1px solid #E9E7EB;border-radius: 20px;padding: 20px;margin-bottom: 20px;"><div  class="no-results">No records found</div></div>');
				}
			} else {
				$("#noResults").remove();
			}
		
        }); 
    });
});
</script>
@endpush

@endsection