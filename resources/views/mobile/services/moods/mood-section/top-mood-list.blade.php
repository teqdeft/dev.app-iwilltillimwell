<div class="mood-card-row">
    @if ( $physically )
        @foreach ($physically as $key => $value )
            <a href="javascript:void(0)" class="open-modal" >
                <div class="mood-feels-img-wrap" key-type="physically"
                            key-name="{{ str_replace(':','',$key) }}" emojino="{{ $value['number'] }}">
                                <div class="mood-card">
                                    <div class="mood-image" onclick="show_popup_mood('happy-modal')">
                                        <img src="{{ asset('assets/dashboard/assets/'.$value['mobile_image']) }}" alt="icon" />    
                                        <input type="radio" value="{{ $key }}" name="physicallyParent" id="{{ $key }}"
                                                    style="display:none;">
                                    </div>
                                    <div class="mood-title">
                                        <p>{{ ucfirst(str_replace(':','',$key)) }}</p>
                                    </div>
                                </div>
                </div>
            </a>
         @endforeach
    @endif
</div>