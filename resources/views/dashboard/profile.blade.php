<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TourFreak - User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background-color: #4cafef;
            color: #fff;
            text-align: center;
            padding: 40px 20px 20px;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .profile-header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .profile-content {
            padding: 30px 20px;
        }

        .profile-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .profile-row:last-child {
            border-bottom: none;
        }

        .profile-label {
            font-weight: 500;
            color: #555;
        }

        .profile-value {
            color: #333;
        }

        @media (max-width: 500px) {
            .profile-row {
                flex-direction: column;
                gap: 5px;
            }

            .profile-label {
                font-weight: 500;
            }
        }
    </style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <h1>Siam Akter Mim</h1>
        <p>Joined August 2025</p>
    </div>
    <div class="profile-content">
        <div class="profile-row">
            <div class="profile-label">Name:</div>
            <div class="profile-value">Siam Akter Mim</div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Email:</div>
            <div class="profile-value">mim15-5924@diu.edu.bd</div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Phone:</div>
            <div class="profile-value">Not Provided</div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Role:</div>
            <div class="profile-value">User</div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Joined Date:</div>
            <div class="profile-value">06 Aug, 2025</div>
        </div>
    </div>
</div>

</body>
</html>
