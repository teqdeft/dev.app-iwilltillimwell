<div class="cbt_analysis_card">

                                        <div class="cbt_title">
                                            <p><span>Let's challenge</span> the thought.</p>
                                        </div>

                                        <div class="text">
                                            <p>Which thought feels most distressing?</p>
                                        </div>

                                        <form class="thought_container_step_three cognitive_distortions thought_con_input mt-4">
                                            <label class="form-check-label">
                                                Automatic Thought
                                            </label>
                                           <div><p class="automatic_thought_display"></p></div>
                                        </form>

                                        <form class="thought_container_step_three thought_con_input mt-4 cbtchallethoughtinput">
                                            <label class="form-check-label">
                                                Write alternative or positive thoughts to challenge your automatic thought.
                                            </label>
                                            <textarea 
                                                id="challenge_thought"
                                                name="challenge_thought"
                                                class="thought-input"

                                                placeholder="e.g., Pilots are highly qualified and experienced, so I am in safe hands."

                                                rows="5">{{$data['challenge_thought']}}</textarea>
                                        </form>

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