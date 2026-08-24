 <div class="left">
     <div class="edit_card_row  @if($data->isEmpty()) no-record-cbt @endif">
        <?php $cbt_list  = Config('constants.CBT_DETAILS'); ?>
        @if($data->isNotEmpty())
                @foreach($data as $result)
                    <?php $distortion_information = json_decode($result->distortion_information); ?>
                    <div class="edit_thought_card">
                        
                        <div class="action_btn">
                            @include('services.cbt.cbt-component.action-btn')
                        </div>

                        <div class="edit_date">
                            <p>{{ \Carbon\Carbon::parse($result['created_at'])->format('F d, Y') }}</p>
                        </div>

                        <div class="thought_text">
                            <p>{{$result['automatic_thought']}}</p>
                        </div>

                        <div class="edti_thought_footer">

                            @include('services.cbt.cbt-distortion-loop-list')
                            @include('services.cbt.cbt-feel-section')
                            
                        </div>

                        <div class="full_reflection">
                            <button 
                                onclick="fullReflection({{ $result['id'] }})" 
                                class="full btn" 
                                type="button" 
                                data-bs-toggle="modal"
                                data-bs-target="#FullReflection">
                                
                                Tap to view full reflection
                            </button>
                        </div>

                    </div>
                @endforeach
        @else
            <div class="edit_thought_card no-cbt-found">
                <p>No CBT records found</p>
            </div>
        @endif
     </div>
 </div>