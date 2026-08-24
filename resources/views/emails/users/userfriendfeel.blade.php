
<!DOCTYPE html>
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
                  <img src="{{ asset('images/logo.png') }}" alt="logo">
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
                     <h4><span>Send By <?= $username ?></span></h4>
                  </div>
                  <div class="regard-box" style="margin: 35px auto;">
                     <h4  style=margin-bottom:8px>Sincerely,</h4>
                     <h5 style="margin:0px;">imwell. Services Team</h5>
                  </div>
                  <hr>
                  <p style="line-height: 1.5;">*High-speed internet and a web camera is needed for video consultations.</p>
               </div>

            </div>
            <div class="footer" style="    background: #994c8d;color: #fff;padding: 24px;text-align: center;">
               <h3 style="margin-bottom:35px;text-align:center;font-weight:500;">Have Questions? Email Customer Service 24/7 at <a href = "mailto: support@imwell.app" style="color:#fff;">support@imwell.app</a></h3>
               <p style="line-height: 1.5;font-size:12px;text-align: center;margin-bottom:25px;">© 2021 imwell. All rights reserved.
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
</html>
