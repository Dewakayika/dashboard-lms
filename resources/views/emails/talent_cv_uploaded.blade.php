<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Confirmation</title>
  <style>
    /* Reset default styles */
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
    .email-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .email-header img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .email-header h1 {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    /* Content styles */
    .email-body {
      font-size: 16px;
      line-height: 1.5;
      color: #555;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
    }

    .email-body p {
      margin-bottom: 20px;
    }

    .bold {
      font-weight: bold;
    }

    /* Signature styles */
    .signature {
      text-align: right;
      font-style: italic;
      color: #888;
    }

    /* Footer styles */
    .email-footer {
      text-align: center;
      font-size: 14px;
      color: #888;
      margin-top: 30px;
    }

    .email-footer a {
      color: #1a73e8;
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
      <h1>Hi {{$name}},</h1>
      <p>Thank You for Submitting Your CV🎉</p>
    </div>

    <!-- Email Content -->
    <div class="email-body">
      <p>Dear {{$name}},</p>
      <p>Thank you for submitting your CV for the <strong>Background Webtoon Designer</strong> position at <strong>Padma Creative Studio</strong>. We truly appreciate your interest and effort in joining our creative team.</p>

      <!-- Selection Process Section -->
      <div class="process">
        <p>We are currently reviewing all applications, including yours, and we will get back to you with further information soon. Recruitment process will be following this steps:</p>
        <ul>
          <li><strong>Submit CV</strong> - Initial review to shortlist candidates.</li>
          <li><strong>Interview</strong> - An interview with our team to assess skills and suitability.</li>
          <li><strong>Announcement</strong> - Final decision and onboarding details via email.</li>
        </ul>
        <p>Each stage will be communicated to you through email, so please stay tuned for updates.</p>
      </div>

      <p>If you have any questions or need more information, feel free to reach out to us.</p>
      <p>Thank you for your patience and understanding.</p>
      <p>Best regards,</p>
      <p class="signature"><strong>Padma Creative Studio</strong><br><a href="mailto:office@padmastudio.io">office@padmastudio.io</a></p>
    </div>

    <!-- Footer -->
    <div class="email-footer">
      <p>Padma Creative Studio | Bali, Indonesia</p>
      <a href="https://padmastudio.io">padmastudio.io</a>
    </div>
  </div>

</body>
</html>
