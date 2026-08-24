@extends('layouts.default')
@section('content')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<div class="banner-sec information-banner inner-main-banner group-counseling-banner">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">Group Counseling</h1>
         <h4 class=" wow fadeInUp animated text-white">Due to COVID-19, all groups will be held remotely</h4>
      </div>
   </div>
</div>
<section class="information-sec">

   <div class="cust-container">
      <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
         <h2 class="theme-heading-text fs-30 lh-1-4">Register Group Counseling</h2>
         <div class="bg-color-cus mb-5 gc-main-container">
            <div class="emergency-contact-form-box mt-4">
               @if (session('message'))
               <div class="alert alert-success" role="alert">
                  {{ session('message') }}
               </div>
               @endif

               <form class="row" action="{{ route('subscribe-to-counseling') }}" id="subscribe-to-counseling" method="post" class="validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                  @csrf
                  <div class="col-sm-12">
                    <div class="form-group">
                       <label for="Counseling">Select Counseling </label>
                       <select class="commanSelect2 form-control groupCounselingSelection" name="select_counseling">

                          <option>Select Group Counseling</option>
                           @foreach($allCounseling as $eachValue)
                              <option value="{{ $eachValue->id}}">
                                      {{ ucfirst($eachValue->title) }}&nbsp
                                      @foreach($eachValue->timeTable as $subValue)
                                        ( {{$subValue->date}} &nbsp {{ $subValue->startTime }} To {{$subValue->endTime}})&nbsp
                                        <br>
                                  @endforeach
                              </option>
                           @endforeach
                       </select>
                    </div>

                  </div>


                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="firs_name">First Name </label>
                        <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="nameHelp" placeholder="Enter First name">
                     </div>
                  </div>

                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="last_name">Last Name </label>
                        <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="nameHelp" placeholder="Enter Last name">

                     </div>
                  </div>

                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" aria-describedby="nameHelp" placeholder="Enter Email">
                     </div>
                  </div>

                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" aria-describedby="numberHelp" placeholder="Enter phone number">
                     </div>
                  </div>

                  <div class="col-sm-6">
                     <div class="form-group">

                        <div id="dropin-container"></div>
                        <input type="hidden" id="nonce" name="payment_method_nonce" />
                     </div>
                  </div>

                  <div class="col-sm-12">
                     <div class="form-group">
                        <input type="submit" class="custom-button btn btn-primary" />
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="content-inner-box">
                  <div class="wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                     <h2 class="theme-heading-text fs-30 lh-1-4">Group Counseling</h2>
                  </div>

                  <p class="mb-0  fs-20 wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">Group counseling is when a small group of people come together to discuss, interact, and explore problems with each other and lead by a group leader.</p>

                  <p class="mb-0  fs-20 wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">Group counseling is a powerful approach to healing. It can be a vital complement to individual counseling and other resources for care.</p>
               </div>
            </div>
         </div>

         <div class="content-box-main wow fadeInUp  mt-3 animated" style="visibility: visible; animation-name: fadeInUp;">
            <h2 class="theme-heading-text fs-30 lh-1-4">Group Counseling</h2>

            <div class="group-guidelines-content2">
               <ul>
                  <li><strong><span class="mr-1">1.</span> Group Leader:</strong> The group leader will lead and guide all sharing and discussions.</li>
                  <li><strong><span class="mr-1">2.</span> Attendance:</strong> Everyone must commit to attending all meetings for the duration of the group cycle. Regular attendance positively impacts the dynamics of the group.</li>
                  <li><strong><span class="mr-1">3.</span>Honesty:</strong> We encourage each member to be open, honest, and truthful. Being sensitive to how words can impact others.</li>
                  <li><strong><span class="mr-1">4.</span>Listening:</strong> We ask that everyone listens to the voices of others and give others time to speak.</li>
                  <li><strong><span class="mr-1">5.</span>Other-Focused with Respect and Dignity:</strong> We give each other the grace and space to fully process their own emotions and thoughts without judgment or interruption.</li>
                  <li><strong><span class="mr-1">6.</span>Self-Focused with Respect and Dignity:</strong> We keep our sharing focused on our own experiences, thoughts, and feelings. We do not criticize or condemn others.</li>
                  <li><strong><span class="mr-1">7.</span>Expressive Communication: </strong> We give feedback to others as long as it reflects our own experiences.</li>
                  <li><strong><span class="mr-1">8.</span>Receptive Communication: </strong>We will be working to understand that people can only speak from their journey in life and who they are.</li>
                  <li><strong><span class="mr-1">9.</span>Forgiveness: </strong> We can only speak from our experiences of joy and pain as we embrace one another. We will be working to forgive one another should hurtful words be spoken.</li>
                  <li><strong><span class="mr-1">10.</span>Confidentiality:</strong> Last but surely not least, all things in a group are confidential.
                     <ul class="pl-3">
                        <li><strong>A. </strong> We commit not to gossip.</li>
                        <li><strong>B. </strong> No branching off and creating personal relationships outside of the group.</li>
                        <li><strong>C. </strong> The group counselor has the right to firmly address any violation of this commitment to confidentiality.</li>
                        <li><strong>D. </strong> Group members may be dismissed from the group if there is a violation.</li>
                     </ul>
                  </li>
                  <li><strong><span class="mr-1">11. </span>Exception to Confidentiality: </strong> If anyone presents harm to self or others, this confidence cannot be held. All persons are mandated by law to report all dangers to themselves and others in order to ensure safety. The staff must also report to the proper authorities any disclosure of past or current unreported child abuse, elder abuse, or abuse to persons who are incapacitated.</li>
               </ul>

               <h6 class="fs-18">*Some of the material above is adapted from the American Group Psychotherapy Association.</h6>
            </div>
         </div>

         <div class="content-box-main wow fadeInUp  mt-4 animated" style="visibility: visible; animation-name: fadeInUp;">
            <h2 class="theme-heading-text fs-30 lh-1-4">Group Participants</h2>

            <p>All groups will be made up of a professional counselor and 6 to 15 group members, depending upon the group topic and the type of group.</p>

            <p><strong>NOTE: </strong> If desired, any group can be offered in combination with a gospel-centered approach. If that is your interest, please send your request to <a href="iwilltilimwell@gmail.com">iwilltilimwell@gmail.com</a>. We will work to construct the group with a minimum of six members.</p>
         </div>

         <div class="content-box-main wow fadeInUp  mt-4 animated" style="visibility: visible; animation-name: fadeInUp;">
            <h2 class="theme-heading-text fs-30 lh-1-4">What to expect</h2>

            <div class="group-guidelines-content2">
               <ul>
                  <li><strong>1.</strong> Group therapy involves one or more mental health professionals who will lead a small group of members up to 15 members.</li>
                  <li><strong>2.</strong> Group sessions meet once per week and last for around 1&ndash;2 hours.</li>
                  <li><strong>3.</strong> At the beginning of a session, group members will introduce themselves and share their reasons for attending group therapy.</li>
                  <li><strong>4.</strong> The exact activities in group therapy sessions will vary from group to group. All activities tend to focus on promoting open, honest communication and establishing trust between group members and the group leaders.</li>
                  <li><strong>5.</strong> Some groups will have homework assignments with an expectation that every member will complete that assignment. Sharing is optional but strongly encouraged.</li>
               </ul>
            </div>
         </div>

         <div class="content-box-main wow fadeInUp  mt-3 animated" style="visibility: visible; animation-name: fadeInUp;">
            <h2 class="theme-heading-text fs-30 lh-1-4">Group Expectations</h2>

            <div class="group-guidelines-content2">
               <ul>
                  <li><strong><span class="mr-1">1.</span> Attendance:</strong> Regular attendance and commitment to the group are very important. If for any reason a member needs to miss a meeting, they should inform their group leader BEFORE missing the meeting, if at all possible.</li>
                  <li><strong><span class="mr-1">2.</span> Confidentiality :</strong> It is expected that all group members will promise to maintain and honor the confidentiality of all.</li>
                  <li><strong><span class="mr-1">3.</span> Expression of Thoughts and Feelings :</strong> Group therapy can often invoke strong thoughts and feelings. It is expected that all thoughts and feelings will be expressed with the greatest amount of respect for all group members.</li>
                  <li><strong><span class="mr-1">4.</span> Receptivity of Thoughts and Feelings:</strong>As we come together to learn and share, we will commit to working towards understanding that some words and actions of others are just consequences of their Journey in Life and Living and may not be intended to hurt anyone. We will work to extend forgiveness to others when forgiveness is necessary for the self, the group, or any members of the group.<br />
                     <strong>NOTE:</strong> This does not void the <a class="theme-color" href="#0"><u>Exception to a Confidentiality clause</u></a>.
                  </li>
                  <li><strong><span class="mr-1">5.</span> Responsibility:</strong> Each group member must take responsibility for working towards their therapeutic goals and reasons for being in the group. It is up to each member to do their own work.</li>
                  <li><strong><span class="mr-1">6.</span> Rules:</strong> Additional group rules and pre-group meetings are usually a part of the group process, and may vary slightly according to the leaders and type of group.</li>
                  <li><strong><span class="mr-1">7.</span> Saying Goodbye:</strong> All members at the end of each group or at the end of the final group session (depending on the group leader, nature, and topic of the group) will be allowed to offer kind salutations to one another and to say goodbye.</li>
               </ul>
            </div>
         </div>
      </div>
   </div>

</section>

<script type="text/javascript">
   const form = document.getElementById('subscribe-to-counseling');

   braintree.dropin.create({
      authorization: "<?php echo $clientToken; ?>",
      container: '#dropin-container'
   }, (error, dropinInstance) => {
      if (error) console.error(error);

      form.addEventListener('submit', event => {
         event.preventDefault();
         let card_no = $("#credit-card-number").val();
         let expiry = $("#expiration").val();
         /*console.log( card_no );
         console.log( expiry );
         if (card_no && expiry) {*/
            dropinInstance.requestPaymentMethod((error, payload) => {
               if (!error) {
                  document.getElementById('nonce').value = payload.nonce;
                  $("#loading").show();
                  form.submit();
               }
            });
      /*   }*/
      });
   });
</script>


@endsection
