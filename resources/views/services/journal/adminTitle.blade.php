<!-- Modal -->
<div class="modal fade written-journal" id="adminTitleModal" tabindex="-1" role="dialog" aria-labelledby="adminTitleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">SELECT YOUR JOURNAL PROMPT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="adminTitleLists">
            @if (!$journal->isEmpty())
                @foreach ($journal as $value)
                    <div class="listItems">
						<div class="item-one">	
							<div class="listCheck">
								<input id="titleJou{{ $value->id }}" type="radio" name="titleName" value="{{ $value->title }}" class="form-control">
							</div>
							<div class="listName">
								<h5><label for="titleJou{{ $value->id }}">{{ $value->title  }}</label></h5>
							</div>
						</div>	
						<div class="listdelete-ico">
							@if (auth()->check() && auth()->user()->id == $value->user_id)
								
								<a class="deleteByAjax" href="javascript:void(0);" number="{{$value->id}}" data-url="{{route('journal-deleted')}}" data-toggle="tooltip" title="" data-bs-original-title="Delete" aria-label="Delete" aria-describedby="tooltip335282"><label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label></a>
							
							@endif
                        </div>
						
                    </div>
                </li>
                @endforeach
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn outline-button" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary selectJournal" data-dismiss="modal">Select</button>
      </div>
    </div>
  </div>
</div>