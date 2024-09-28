<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Confirmation</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f3f4f6;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .email-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    .email-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .email-header img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .email-header h1 {
      font-size: 24px;
      margin-bottom: 8px;
    }

    .email-header p {
      color: #6b7280;
      font-size: 16px;
    }

    .email-body {
      background-color: #f9fafb;
      padding: 20px;
      border-radius: 8px;
      margin-top: 20px;
    }

    .email-body p {
      color: #374151;
      margin-bottom: 16px;
      line-height: 1.6;
    }

    .email-body strong {
      font-weight: bold;
    }

    .email-footer {
      text-align: center;
      margin-top: 30px;
      font-size: 14px;
      color: #9ca3af;
    }

    .email-footer a {
      color: #3b82f6;
      text-decoration: none;
    }

    .email-footer a:hover {
      text-decoration: underline;
    }

    @media (max-width: 640px) {
      .email-container {
        padding: 15px;
      }

      .email-body {
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="email-container">
    <!-- Header -->
    <div class="email-header">
      <img src="https://drive.google.com/drive-viewer/AKGpihaLtc9zIZp8nwaDseZHrt7OAa1Q8jUsmv9JNWaALpSNIKEnwMfB31TBUHPea3pTr7DlMjIOjFWjCKZ_EcI68_O52d48YTdvK_k=s2560" alt="Padma Studio">
      <h2>Hi {{$name}},</h2>
      <p>Thank You for Submitting Your CV🎉</p>
    </div>

    <!-- Email Content -->
    <div class="email-body">
      <p>Dear {{$name}},</p>
      <p>Thank you for submitting your CV for the <strong>Background Webtoon Designer</strong> position at <strong>Padma Creative Studio</strong>. We truly appreciate your interest and effort in joining our creative team.</p>
      <p>We are currently reviewing all applications, including yours, and we will get back to you with further information soon. Please wait for our next update regarding the recruitment process via email.</p>
      <p>If you have any questions or need more information, feel free to reach out to us.</p>
      <p>Thank you for your patience and understanding.</p>
      <p>Best regards,</p>
      <p><strong>Padma Creative Studio</strong></p>
      <a href="mailto:office@padmastudio.io">office@padmastudio.io</a>
    </div>

    <!-- Footer -->
    <div class="email-footer">
      <p>Padma Creative Studio | Bali, Indonesia</p>
      <a href="https://padmastudio.io">padmastudio.io</a>
    </div>
  </div>

</body>
</html>
