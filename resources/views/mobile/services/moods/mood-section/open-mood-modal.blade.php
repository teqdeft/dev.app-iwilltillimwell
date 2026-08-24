<div id="happy-modal" class="modal happy-modal-v1">
    <div class="modal-content">
            <span class="close-modal">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="close icon" onclick="skipe_function('')"/>
            </span>
            <div class="happy-modal-content">

                <div class="form-row happy-mood-modal">

                    <div class="col-100 form-group">
                        <div class="fel-title selectedMoodParent">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-100 form-group ">
                        
                    @if($physically )
                        @foreach ($physically as $key => $value )

                        <?php $mood_number = $value['number']; ?>

                            <div id="mood-<?php echo $mood_number ?>" class="mood-sub-mood-main-div-<?php echo $mood_number ?> moods-face-dynamic moods-child-physically mood-child-physically-{{ str_replace(':','',$key) }} check-group">
                               @foreach ($value['child'] as $childKey => $childValue ) 


                               
                                    <div 
                                        
                                        @if(str_replace(':','',$childKey) == 'OTHER' )  
                                            class="mood-sub-mood-child-div-<?php echo $mood_number ?> custom-checkbox other-parent-div {{ str_replace(':','',$childKey.'-'.$key) }}-sub" 
                                        @else 
                                            class="mood-sub-mood-child-div-<?php echo $mood_number ?> custom-checkbox "   
                                        @endif>
                                        
                                        <input 
                                        type="radio" 
                                            @if(str_replace(':','',$childKey) == 'OTHER' )
                                                id="{{ str_replace(':','',$childKey.'-'.$key) }}"
                                            @else     
                                                id="{{ str_replace(':','',$childKey) }}" 
                                            @endif

                                        name="physicallyChild" 
                                        value="{{ $childKey }}" 
                                        class="childMoodfaces"
                                        keyname="{{ str_replace(':','',$childKey) }}"
                                        key-type="physically"
                                        mainMood="{{ str_replace(':','',$key) }}"
                                        mood_number = '<?php echo $mood_number ?>'
                                        
                                        >
                                        <label 
                                                @if(str_replace(':','',$childKey) == 'OTHER' )
                                                 for="{{ str_replace(':','',$childKey.'-'.$key) }}"
                                                 class="checkbox-label {{ str_replace(':','',$childKey.'-'.$key) }}"
                                                @else 
                                                 for="{{ str_replace(':','',$childKey) }}" 
                                                 class="checkbox-label"
                                                @endif
                                            
                                            
                                        >
                                            <span class="checkbox-indicator"></span>
                                            <span  @if(str_replace(':','',$childKey) == 'OTHER' ) class="other_name" @endif>{{ str_replace(':','',$childKey) }}</span>
                                        </label>
                                    </div>

                                    


                                @endforeach    
                            </div>        
                        @endforeach     
                    @endif
                       
                    </div>

                    <div class="col-100 form-group t-l other-option-div">
                        <label>Your thoughts</label>
                        <textarea placeholder="Enter here"  rows="4" name="customMood" class="customMood"></textarea>
                    </div>
                    <div class="hap-cta other-option-div">
                        <button class="outline-button" type="button" onclick="skipe_function()">Skip</button>
                        <button class="primary-button" type="button" onclick="save_function_custome()">Save</button>
                    </div>

                    <div class="col-100 form-group">
                        <div class="fel-title selectedMoodChild" style="display: none;">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-100 form-group check-group">
                    <?php 
                    $counter=1;
                    ?>   
                    @foreach ($physically as $key => $value )
                         @foreach ($value['child'] as $childKey => $childValue )

                         <div
                            
                            class="moods-face-dynamic moods-face-subChild-physically mood-subChild-physically-{{ str_replace(':','',$key) }}-{{ str_replace(':','',$childKey) }}" >
                            
                            @foreach ($childValue as $subChildKey => $subChildValue )

                            <div 
                             id = "parent_child_sub_child_<?php echo $counter?>"
                             keyname="{{ $subChildValue }}"
                             class="parent_sub_child custom-checkbox">
                            
                            <input type="radio" 
                            id="phy-sub-{{ str_replace(':','',$key.'-'.$subChildKey.'-'.$subChildValue.'-'.$counter) }}" 
                            name="physicallySubChild"
                            value="{{ $subChildKey }}" 
                            counter_id='<?php echo $counter?>'
                            />

                                <label for="phy-sub-{{ str_replace(':','',$key.'-'.$subChildKey.'-'.$subChildValue.'-'.$counter) }}" class="checkbox-label subChildMood">
                                    <span class="checkbox-indicator"></span>
                                    <span class="subchildname">{{ $subChildValue }}</span>
                                </label>
                               
                            </div>

                            <?php $counter++;?>
                            @endforeach
                        </div>

                         @endforeach
                    @endforeach        

                    </div>

                    <div class="other-option-div-child" style="display: none;width:100%;">
                        <div class="col-100 form-group t-l ">
                            <label>Your thoughts</label>
                            <textarea placeholder="Enter here"  rows="4" name="customMood" class="customMood"></textarea>
                        </div>
                        <div class="hap-cta ">
                            <button class="outline-button" type="button" onclick="skipe_function()">Skip</button>
                            <button class="primary-button" type="button" onclick="save_function_custome()">Save</button>
                        </div>
                    </div>

                    <div class="other-option-div-sub-child" style="display: none;width:100%;">
                        <div class="col-100 form-group t-l ">
                            <label>Your thoughts</label>
                            <textarea placeholder="Enter here"  rows="4" name="customMood-sub" class="customMood-sub"></textarea>
                        </div>
                        <div class="hap-cta ">
                            <button class="outline-button" type="button" onclick="skipe_function()">Skip</button>
                            <button class="primary-button" type="button" onclick="save_function_custome()">Save</button>
                        </div>
                    </div>

                    <div class="hap-cta saveMood" style="display: none;">
                        <a href="javascript:void(0)" class="outline-button" onclick="skipe_function('')">Back</a>
                       <button type="submit" class="primary-button">Save</button>
                    </div>
        </div>
    </div>
    </div>
</div>   
  