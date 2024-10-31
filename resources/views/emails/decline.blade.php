<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update on Your Background Webtoon Designer Application</title>
  <style>
    /* Reset some default styles */
    body, p, h1, h2, h3, h4, h5, h6 {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    /* Email container styles */
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 30px;
      background-color: #f7f7f7;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Header styles */
    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h1 {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    /* Content styles */
    .content {
      font-size: 16px;
      line-height: 1.5;
      color: #555;
    }

    .content p {
      margin-bottom: 20px;
    }

    .bold{
        font-weight: bold;
    }

    .signature {
      text-align: right;
      font-style: italic;
      color: #888;
    }

    /* Footer styles */
    .footer {
      text-align: center;
      font-size: 14px;
      color: #888;
      margin-top: 30px;
    }

    .footer a {
      color: #1a73e8;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h1>Padma Creative Studio</h1>
    </div>
    <div class="content">
      <p>Dear, <span class="bold">{{$userName}}</span></p>
      <p>Thank you very much for taking the time to submit your CV and for your interest in joining us as a Background Webtoon Designer. We truly appreciate your enthusiasm and the effort you put into applying to Padma Creative Studio.</p>
      <p>After carefully reviewing all applications, we have decided to move forward with another candidate whose qualifications more closely match the requirements for this role. This decision in no way reflects on your skills or experience, which we respect and value.</p>
      <p>We encourage you to stay connected and to consider applying for other opportunities with us in the future. Please feel free to follow our job openings and keep us in mind for upcoming roles.</p>
      <p>Once again, thank you for your interest in joining our team. We wish you all the best in your future career endeavors.</p>
      <p class="signature">Best regards,<br>Padma Creative Studio</p>
    </div>
    <div class="footer">
      <p>Padma Creative Studio | Bali, Indonesia</p>
      <p><a href="https://padmastudio.io">padmastudio.io</a></p>
      <p><a href="mailto:office@padmastudio.io">office@padmastudio.io</a></p>
    </div>
  </div>
</body>
</html>