




<div class="cbt_analysis_card">
    <div class="cbt_title"> <p><span>What thoughts</span> went through your mind?</p></div>
    <form class="thought_container_step_one thought_con_input mt-4">
        <label class="form-check-label">Write down your thoughts exactly as they come to your mind. Don't filter them out.</label>
        <textarea 
        class="thought-input" 
        placeholder="e.g., The plane might crash"
        name="automatic_thought" 
        id="automatic_thought" rows="5">{{$data['automatic_thought']}}</textarea>
    </form>

                                        <div class="cbt_analy_footer first_step">
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