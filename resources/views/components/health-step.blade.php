<div class="col-md-12 grid-margin">
    <div class="containerNext float-right">
        @if ( !empty($steps) )
            @if ( isset($steps['prev']) )
                <a href="{{ $steps['prev']  }}" class="btn btn-primary"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
            @endif
            @if ( isset($steps['next']) )
                <a href="#!"  next-step="{{ $steps['next']  }}" form-type="{{  $explodeCheck??'' }}" class="btn btn-primary saveAndNextHealth @if(!$healthStep) showAddInfoModalHealthStepOne @endif">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
            @endif
        @endif
    </div>
</div>
