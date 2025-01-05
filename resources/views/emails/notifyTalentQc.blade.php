<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Padma Creative Studio - Apply Project Succesfully</title>
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
        <h1>New Project Application</h1>
    </div>
    <p>Dear <strong>{{ $talentQc }}</strong>,</p>
    <p>{{ $applicant->name }} has been apply new project which is <strong>{{ $project->name }}</strong>.</p>

    <p><strong>Applicant Details:</strong></p>
    <ul>
        <li><strong>Name:</strong> {{ $applicant->name }}</li>
        <li><strong>Email:</strong> {{ $applicant->email }}</li>
    </ul>
    <p>Make sure you're contact with {{ $applicant->name }} and log in to your dashboard to review the project</p>
    <p>Thank you,</p>
    <p><strong>Padma Creative Studio</strong></p>
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
  </div>
</body>
</html>
