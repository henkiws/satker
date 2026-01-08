<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Admin Panel'; ?> - <?php echo APP_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            dark: '#0F2854',
                            DEFAULT: '#1C4D8D',
                            light: '#4988C4',
                            accent: '#BDE8F5'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link:hover {
            background-color: #1C4D8D;
            border-left: 4px solid #BDE8F5;
        }
        .sidebar-link.active {
            background-color: #1C4D8D;
            border-left: 4px solid #BDE8F5;
        }
    </style>
</head>
<body class="bg-gray-50">