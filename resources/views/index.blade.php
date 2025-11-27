<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsPortal - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light px-3 border-bottom">
    <span class="navbar-brand mb-0 h1">NewsPortal</span>

    <div>
        <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-sm">Admin Login</a>
        <a href="#" class="btn btn-primary btn-sm">Sign Up</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="text-center p-5 bg-primary text-white">
    <h1>Stay Updated with Fresh News</h1>
    <p>Breaking stories, local coverage, and world news — all in one place.</p>
    <a href="#" class="btn btn-light">Explore News</a>
</section>

</body>
</html>
