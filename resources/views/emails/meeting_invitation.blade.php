<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Invitation</title>
</head>
<body>
    <h2>Undangan Meeting: {{ $meetingData['title'] }}</h2>
    <p>{{ $meetingData['description'] }}</p>
    <p><strong>Tanggal:</strong> {{ $meetingData['startDateTime']->format('d M Y') }}</p>
    <p><strong>Waktu:</strong> {{ $meetingData['startDateTime']->format('H:i') }} - {{ $meetingData['endDateTime']->format('H:i') }}</p>
    <p><strong>Link Google Meet:</strong> <a href="{{ $meetingData['googleMeetLink'] }}">{{ $meetingData['googleMeetLink'] }}</a></p>    
</body>
</html>
