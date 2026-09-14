@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner security-platform-banner">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">Delete Your Account</h1>
      </div>
   </div>
</div>
<section class="information-sec">
   <div class="cust-container">
      <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
         <div class="group-guidelines-content2 group-guidelines-new ">
            <h2 class="theme-heading-text fs-30 wow fadeInUp animated">Request deletion of your I Will Til I'm Well account</h2>
            <p class="wow fadeInUp animated">This page explains how to request permanent deletion of your <strong>I Will Til I'm Well</strong> account and the
               data associated with it. The I Will Til I'm Well mobile app and this website are operated by <strong>I Will Til I'm Well, Inc.</strong></p>

            <h2 class="theme-heading-text fs-30 wow fadeInUp animated">How to delete your account from the app</h2>
            <p class="wow fadeInUp animated">Step 1. Log in to the I Will Til I'm Well app, or at <a href="{{ url('/') }}">{{ parse_url(url('/'), PHP_URL_HOST) }}</a>.</p>
            <p class="wow fadeInUp animated">Step 2. Go to your profile.</p>
            <p class="wow fadeInUp animated">Step 3. Click on <strong>Delete account</strong>.</p>
            <p class="wow fadeInUp animated">Step 4. Click on <strong>Confirm</strong>.</p>
            <p class="wow fadeInUp animated">Step 5. Your account is closed immediately and permanent deletion is completed within 30 days.</p>

            <h2 class="theme-heading-text fs-30 wow fadeInUp animated">How to request deletion by email</h2>
            <p class="wow fadeInUp animated">If you cannot access your account, email
               <a href="mailto:support@iwilltilimwell.com?subject=Account%20deletion%20request">support@iwilltilimwell.com</a>
               from the email address registered on the account, with the subject line <strong>Account deletion request</strong>.
               Include the full name and email address on the account. Never send us your password. We verify that the request comes
               from the account holder, delete the account, and email you a confirmation &mdash; normally within 7 days, and no later
               than 30 days from the verified request.</p>

            <h2 class="theme-heading-text fs-30 wow fadeInUp animated">What is deleted, and what is kept</h2>
            <p class="wow fadeInUp animated">The following data is <strong>permanently deleted</strong> when your account is deleted:</p>
            <ul class="wow fadeInUp animated">
               <li>Your account profile &mdash; name, email address, phone number, date of birth, gender and postal address.</li>
               <li>Your login credentials, authentication tokens and active sessions.</li>
               <li>Your health and wellness records created in the app, including journals, affirmations, screenings and messages to specialists.</li>
               <li>Your appointment and consultation history, except where retention is required by law (see below).</li>
               <li>Your dependent profiles linked to the account.</li>
            </ul>
            <p class="wow fadeInUp animated">The following data is <strong>retained</strong> after deletion:</p>
            <ul class="wow fadeInUp animated">
               <li>App usage and diagnostic logs, which are deleted or irreversibly anonymised within 90 days.</li>
               <li>Billing, payment and transaction records, retained for 7 years as required by tax and financial regulations, then deleted.</li>
               <li>Medical and treatment records, retained for the period required by applicable state and federal healthcare
                  record-retention law. These records are access-restricted and are deleted once the statutory retention period ends.</li>
            </ul>

            <h2 class="theme-heading-text fs-30 wow fadeInUp animated">Important</h2>
            <p class="wow fadeInUp animated">Deletion is permanent. Once your account is deleted it cannot be restored, and any remaining
               subscription period is forfeited. Cancel your subscription before requesting deletion if you want to avoid further billing.</p>
            <p class="wow fadeInUp animated">If you want only some of your data deleted rather than your whole account, email
               <a href="mailto:support@iwilltilimwell.com">support@iwilltilimwell.com</a> and tell us what you would like removed, and we
               will action that request instead.</p>
            <p class="wow fadeInUp animated">For more information on how we handle your data, see our
               <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>.</p>
         </div>
      </div>
   </div>
</section>
@endsection
