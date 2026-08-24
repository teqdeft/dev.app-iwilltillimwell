@include('emails.users.inc.email-header')                <tr>                    <td style="position: relative; padding: 0 30px;">                        <h1 style="color:#000; font-size: 17px; margin-top: 10px; margin: 40px 0 0px;">Hi <?= ucfirst($msg['shared_on_name']) ?>,</h1>                    </td>                </tr>                 <tr>                    <td style="position: relative; padding: 0 30px;">                                               <div class="reset-pwe" style="margin: 10px 0 5px;">                            <p style="font-size: 15px; line-height: 24px;"> <?= ucfirst($username) ?> is inviting you to record an uplifting positive affirmation to be stored in their personal journal to remind them of how important they are or how they add value to the lives of others.</p>                        </div>                         <div class="reset-pwe" style="margin: 10px 0 15px;">                            <p style="font-size: 15px; line-height: 24px;">Please check link below:- <br>                                 							<a href="<?= $msg['linkEcrypt'] ?>" style="font-weight:600; color: #683E95; text-decoration: none; display: block; margin-top: 10px;"><?= $msg['linkEcrypt'] ?></a>							                            </p>                        </div>                         <div class="reset-pwe" style="margin: 10px 0 15px;">                            <h1 style="color:#000; font-size: 15px; margin-top: 20px; ">Message:- </h1>                            <p style="font-size: 15px; line-height: 24px; margin-top: 0; padding: 0;"><?= $msg['message'] ?></p>                        </div>                    </td>                </tr>                                <tr>                    <td style="position: relative; padding: 0 30px;">                        <h1 style="color:#000; font-size: 15px; margin-top: 10px;">Send by <?= $username ?></h1>                    </td>                </tr>                 <tr>                    <td style="position: relative; padding: 0 30px;">                        <h1 style="color:#000; font-size: 15px; margin-top: 10px; font-weight: 600;">						Note:- &nbsp; High-speed internet and a web camera is needed for video consultations.</h1>                    </td>                </tr>                <tr>                    <td style="position: relative; padding: 0 30px;">                                                                                            <div class="reset-pwe" style="margin: 10px 0 15px;">                            <p style="font-size: 15px; line-height: 24px;">Have Questions? Email Customer Service 24/7 at                                 <span><a href="mailto:support@iwilltilimwell.com"                                style="font-weight:600; color: #683E95; text-decoration: none;">support@iwilltilimwell.com</a></span>                            </p>                        </div>                        <div class="account" style="position: relative;">                            <p style="font-size: 15px; line-height: 24px;">This e-mail and any attachments are for the                                exclusive and confidential use of the intended recipient. If you have received this                                message in error, please notify us immediately by return e-mail and promptly delete this                                message and its attachments from your computer system. We do not waive attorney-client,                                work product, doctor-patient or intellectual property privileges by the transmission of                                this message.</p>                        </div>                                                                     <div class="regards" style="margin: 40px 0 50px;">                            <p style="color:#000; font-size: 15px; margin-top: 20px; font-weight: 600;">Regards,<br> <strong> Iwilltilimwell</strong>                            </p>                        </div>                    </td>                </tr>				@include('emails.users.inc.email-footer')                <?php /*<!DOCTYPE html>
<html>
   <head>
      <title>imwell</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body style="font-family: 'open sans', 'helvetica neue', sans-serif;">
      <div class="main-wrapper" style="width: 100%;max-width: 730px;background:#f6eff5;margin: 50px auto;border-radius: 5px;box-shadow: 0px 4px 10px 2px #0000001c;">
         <div class="inner-wrapper">
            <div class="header-section">
               <div class="inner-header-section">
                  <a href="{{env('APP_URL')}}" style="display: inline-block;margin: auto;width: 100%;text-align: center;padding: 30px 0px;">
                  <img src="https://www.iwilltilimwell.com/uploads/companies/company-logo-1702555584.png" alt="logo">
                  </a>
               </div>
            </div>
            <div class="main-body-content" style="padding: 15px 30px;">
               <div class="inner-main-body-content">
                  <div class="intro-text-box">
                     <div class="newsletter-box">
                        <?= $msg['title'] ?>
                        <?= $msg['body'] ?>
                        </div>
                     <h4 style="margin-bottom:10px; margin-top: 50px;"><span>Send by <?= $username ?></span></h4>
                  </div>
                  <div class="regard-box" style="margin-bottom: 35px;">
                     <h4 style="margin-bottom:4px">Sincerely,</h4>
                     <h5 style="margin:0px;">imwell. Services Team</h5>
                  </div>
                  <hr>
                  <p style="line-height: 1.5;">*High-speed internet and a web camera is needed for video consultations.</p>
               </div>

            </div>
            <div class="footer" style="    background: #994c8d;color: #fff;padding: 24px;text-align: center;">
               <h3 style="margin-bottom:35px;text-align:center;font-weight:500;">Have Questions? Email Customer Service 24/7 at <a href = "mailto: support@imwell.app" style="color:#fff;">support@imwell.app</a></h3>
               <p style="line-height: 1.5;font-size:12px;text-align: center;margin-bottom:25px;">© <?= date('Y') ?> imwell. All rights reserved.
                  You have received this message because<br> you are a member of imwell
               </p>
               <p style="line-height: 1.5;font-size:12px;">This e-mail and any attachments are for the exclusive and confidential use of
                  the intended recipient. If you have received this message in error, please notify us immediately by
                  return e-mail and promptly delete this message and its attachments from your computer system. We do not waive
                  attorney-client, work product, doctor-patient or
                  intellectual property privileges by the transmission of this message.
               </p>
            </div>
         </div>
      </div>
   </body>
</html>*/ ?>
