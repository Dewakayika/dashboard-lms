<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Padma Creative Studio - Job Application</title>
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

    .padma {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #333;
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

        <p>Hello {{ $project->talent_qc }},</p>
        <p>You have been assigned as the QC for the project "{{ $project->comic_name }}" (Chapter {{ $project->chapter_number }}).</p>
        <p>Details:</p>
        <ul>
            <li>Total Panels: {{ $project->number_of_panel }}</li>
            <li>File Link: <a href="{{ $project->file }}">{{ $project->file }}</a></li>
        </ul>
        <p>Thank you!</p>

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
