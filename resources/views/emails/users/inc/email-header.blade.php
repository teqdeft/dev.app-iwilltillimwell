<!DOCTYPE html>
<html>
<head>
    <title>iwilltilimwell</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
    @media (min-width: 768px) and (max-width: 991px) {
            .footer-top {
                display: block !important;
            }
            .footer-bottom {
                display: block !important;
                margin-top: 12px;
                padding-top: 15px;
            }
        }
    @media (min-width: 320px) and (max-width: 767px) {
            .footer-top {
                display: block;
            }

            .footer-bottom {
                display: block;
                margin-top: 12px;
                padding-top: 15px;
            }
        }
    </style>
</head>
<body style="font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 24px;">
    <div class="main-wrapper"
        style="width: 100%; max-width: 750px; background:#fff; border-radius: 5px;">
        <table
            style="background-image: url({{env('APP_URL')}}/images/template-backgroud-logo.png); background-size: inherit; background-position: center right; background-repeat: no-repeat;">
            <tbody style="box-shadow: 0 0 6px #80808087; border-radius: 8px;">
                <tr style="background-color: #683E95;  position: relative;">
                    <th style="padding: 20px 30px;"> 
						<a href="{{env('APP_URL')}}" class="logo"
                            style="height: auto; width: 300px; max-width: 60%; display: block;"> 
								<img
                                src="{{env('APP_URL')}}/images/template-logo.png" 
								alt="logo"
                                style="height: 100%; width: 100%; object-fit: cover;"
								/> 
						</a> 
					</th>
                </tr>