<!DOCTYPE html>
<html>

<head>
    <title>Contact Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa; padding: 20px;">

    <div class="container">
        <div class="card shadow-lg mx-auto" style="max-width: 600px; border-radius: 10px;">
            <div class="card-header bg-primary text-white text-center"
                style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h2 class="my-2">{{ $subject }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $name }}</p>
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Phone:</strong> {{ $phone }}</p>
                <p><strong>Message:</strong></p>
                <div class="p-3 bg-light border rounded">
                    <p>{{ $comment }}</p>
                </div>
            </div>
            <div class="card-footer text-center bg-light"
                style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <p class="mb-0">Thank you!</p>
            </div>
        </div>
    </div>

</body>

</html>
