
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $meetingData['title'] }}</title>
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
      <p>Dear Participant!</p>
      <p>Thank you for applying for the position of Background Webtoon Designer at Padma Creative Studio. We were impressed by your application and would like to invite you for an interview to discuss this exciting opportunity.</p>

      <p>Interview Detail Information</p>
      <p><strong>Date:</strong> {{ $meetingData['startDateTime']->format('d M Y') }}</p>
      <p><strong>Time:</strong> {{ $meetingData['startDateTime']->format('H:i') }} - {{ $meetingData['endDateTime']->format('H:i') }} WITA</p>
      <p><strong>Link Google Meet:</strong> <a href="{{ $meetingData['googleMeetLink'] }}">{{ $meetingData['googleMeetLink'] }}</a></p>

      
      <p>During the interview, you’ll have the opportunity to meet with our team, discuss your skills and experience, and learn more about the role and our studio's creative vision. </p>
      <p>To confirm your availability for the interview, please reply to this email or contact us at <a href="https://wa.me/821081931708">Padma Studio WhatsApp</a></p>

      <p>We look forward to the chance to get to know you better and to explore how your talents could contribute to our team!</p>
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
