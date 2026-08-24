<div class="cbt_analysis_card">

    <div class="cbt_title">
        <p><span>Let's identify</span> any cognitive distortions.</p>
    </div>


    <form class="thought_con_input cognitive_distortions thought_container_step_two mt-4">
        <label class="form-check-label">
            Automatic Thought
        </label>
        <div>
            <p class="automatic_thought_display"></p>
        </div>
    </form>


    <div class="step_tow_cards">
        <!-- <div class="text">
                                                <p>What thinking patterns do you notice?</p>
                                            </div> -->

        <div class="text">
            <p>What thinking patterns do you notice in each thought?</p>
        </div>

        <div class="all_cards">


            @php
            $distortion_information = [];
            $selectedDistortions = [];
            if(isset($data['distortion_information'])) {

            $distortion_information = json_decode($data['distortion_information'], true);
            if($distortion_information) {

            foreach ($distortion_information as $item) {
            $selectedDistortions[$item['distortion_id']] = $item['intensity'];
            }
            }
            }
            @endphp




            @foreach (Config('constants.CBT_DETAILS') as $key => $value )


            <div class="patterns_card {{ isset($selectedDistortions[$value['distortion_id']]) ? 'active' : '' }}" >

                <div class=" form-check">
                        <p class="card_title">{{ $value['title'] }}</p>
                        <label class="form-check-label" for="cbt_{{ $key }}">
                        </label>
                        <input
                            class="form-check-input"
                            type="checkbox"

                            id="cbt_{{ $key }}"
                            name="cbt[{{ $key }}][selected]"
                            value="{{$value['distortion_id']}}"

                            {{ isset($selectedDistortions[$value['distortion_id']]) ? 'checked' : '' }}>
                </div>

            <div class="card_text">
                <p>{{ $value['short'] }}</p>
            </div>
            <div class="card_btn">
                <button class="descri btn" type="button"
                    onclick="SeeDescriptionMore({{ $key }})">See Description</button>
            </div>
            <div class="select_option">
                <label>Intensity</label>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                    <input type="radio" class="btn-check" name="cbt[{{ $key }}][intensity]" id="low_{{ $key }}" autocomplete="off"
                        value="low"
                        {{ (isset($selectedDistortions[$value['distortion_id']]) && $selectedDistortions[$value['distortion_id']] == 'low') ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="low_{{ $key }}">Low</label>

                    <input type="radio" class="btn-check" name="cbt[{{ $key }}][intensity]" id="medium_{{ $key }}" autocomplete="off"
                        value="medium"
                        {{ (isset($selectedDistortions[$value['distortion_id']]) && $selectedDistortions[$value['distortion_id']] == 'medium') ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="medium_{{ $key }}">Medium</label>

                    <input type="radio" class="btn-check" name="cbt[{{ $key }}][intensity]" id="high_{{ $key }}" autocomplete="off"
                        value="high"
                        {{ (isset($selectedDistortions[$value['distortion_id']]) && $selectedDistortions[$value['distortion_id']] == 'high') ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="high_{{ $key }}">High</label>


                </div>
                <div class="error-intensity-section" style="display: none;"><p style="color:red">Please select Intensity</p></div>
            </div>
        </div>

        @endforeach



    </div>


        <div class="distortion_load_main">    

            <button class="btn distortions_load more">       
                    <span class="btn-text-more">Load More</span>
                    <span class="next_icon">         
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.0001 4H13.0001V16L18.5001 10.5L19.9201 11.92L12.0001 19.84L4.08008 11.92L5.50008 10.5L11.0001 16V4Z" fill="black"/>
                        </svg>    
                    </span>     
            </button> 

        </div>


</div>


<div class="cbt_analy_footer">

    <button class="btn thought_previous_btn" onclick="prevStep()">
        <span class="next_icon">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 3L16.8 7.5L39 30L16.8 52.5L21 57L48 30L21 3Z" fill="#683D81" />
            </svg>
        </span>
        Previous
    </button>

    <button class="btn thought_next_btn" onclick="nextStep()">
        Next
        <span class="next_icon">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 3L16.8 7.5L39 30L16.8 52.5L21 57L48 30L21 3Z" fill="#683D81" />
            </svg>
        </span>
    </button>

</div>

</div>


<script>
const observer = new MutationObserver(() => {
  const cards = document.querySelectorAll('.patterns_card.cbt-error-card');

  if (cards.length) {
    cards[cards.length - 1].scrollIntoView({
      behavior: 'smooth',
      block: 'center'
    });
  }
});

observer.observe(document.body, {
  subtree: true,
  childList: true,
  attributes: true,
  attributeFilter: ['class']
});
</script>