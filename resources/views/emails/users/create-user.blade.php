<!DOCTYPE html>
<html>
   <head>
      <title>iwilltilimwell</title>
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
                     <h4><span>Dear {{ $user_name }},</span></h4>
                     <p style="line-height: 1.5;">Welcome to iWILL ‘til i’mWELL. As a member, you and your family now have round-the-clock access to U.S.-based licensed physicians for telephone and video* consultations.

                     </p>
                     <div class="newsletter-box">
                    <h4> To get started please follow the link below</h4>
                  <h4> <a href="{{ url('/') }}/login" target="_blank" style="color: #994c8d;">{{env('APP_URL')}}/login</a></h4>
                    <table style="border-collapse: collapse;width: 100%;text-align:left;">

                              <tr>
                                <th style="  border: 1px solid #ddd;padding: 8px 20px;">User Name</th>
                                <td style="  border: 1px solid #ddd;padding: 8px 20px;">{{ $email }}</td>
                              </tr>
                              <tr>
                                <th style="  border: 1px solid #ddd;padding: 8px 20px;">Password</th>
                                <td style="  border: 1px solid #ddd;padding: 8px 20px;">{{ $password }}</td>
                              </tr>


                            </table>


                     </div>
                     <p style="line-height: 1.5;">Your account is activated. You will have
                        access to manage your personal health records, consult with a physician and so much more.
                     </p>
                     <p style="line-height: 1.5;">If you have any questions, please email Customer Service day or night at <a href = "mailto: support@iwilltilimwell.com" style="color: #994c8d;
    font-weight: 600;">support@iwilltilimwell.com.</a></p>
                     <p style="line-height: 1.5;">We look forward to providing you with Healthcare when you NEED it most.</p>
                  </div>
                  <div class="regard-box" style="margin: 35px auto;">
                     <h4  style=margin-bottom:8px>Sincerely,</h4>
                     <h5 style="margin:0px;">iWILL ‘til i’mWELL. Services Team</h5>
                  </div>
                  <hr>
                  <p style="line-height: 1.5;">*High-speed internet and a web camera is needed for video consultations.</p>
               </div>

            </div>
            <div class="footer" style="    background: #994c8d;color: #fff;padding: 24px;text-align: center;">
               <h3 style="margin-bottom:35px;text-align:center;font-weight:500;">Have Questions? Email Customer Service 24/7 at <a href = "mailto: support@iwilltilimwell.com" style="color:#fff;">support@iwilltilimwell.com</a></h3>
               <p style="line-height: 1.5;font-size:12px;text-align: center;margin-bottom:25px;">© 2021 iWILL ‘til i’mWELL. All rights reserved.
                  You have received this message because<br> you are a member of iWILL ‘til i’mWELL
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
