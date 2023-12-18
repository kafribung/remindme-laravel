<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Reminderme Scheduled Email</title>
</head>

<body class="bg-gray-100 p-4">

    <div class="max-w-md mx-auto bg-white rounded p-8 shadow-md">
        <h2 class="text-2xl font-bold mb-4">Reminder Scheduled Notification</h2>

        <p class="mb-4">Hello {{ $reminder->user->name }},</p>

        <p class="mb-4">We would like to inform you that your remind has been scheduled for the following date and
            time:</p>

        <ul class="list-disc pl-4 mb-4">
            <li><strong>Title:</strong> {{ $reminder->title }}</li>
            <li><strong>Description:</strong> {{ $reminder->description }}</li>
            <li><strong>Scheduled Date and Time:</strong> {{ $reminder->epochToDate($reminder->remind_at) }}</li>
            <li><strong>Event:</strong> {{ $reminder->epochToDate($reminder->event_at) }}</li>
        </ul>

        <p class="mb-4">Thank you for your contribution!</p>

        <p>Best regards,<br>Your Website Team</p>
    </div>

</body>

</html>
