<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsPortal - Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)),
                        url('https://images.unsplash.com/photo-1524638067-feba1a3c2a06?auto=format&fit=crop&w=1200&q=80') no-repeat center center/cover;
            padding: 120px 20px;
            color: white;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light px-3 border-bottom">
    <span class="navbar-brand mb-0 h1 fw-bold">NewsPortal</span>

    <div>
        <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-sm me-2">Admin Login</a>
        <a href="{{ route('register.form') }}" class="btn btn-primary btn-sm">Sign Up</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero text-center">
    <h1 class="display-5 fw-bold">Stay Updated with Fresh News</h1>
    <p class="lead">Breaking stories, local coverage, and world news — all in one place.</p>
    <a href="#" class="btn btn-light btn-lg mt-3">Explore News</a>
</section>

<!-- Features Section -->
<section class="container my-5">
    <h3 class="text-center section-title">Why Choose NewsPortal?</h3>

    <div class="row text-center">
        <div class="col-md-4 p-3">
            <h5>✔ Fast & Reliable</h5>
            <p>Get real-time updates as news breaks around you.</p>
        </div>

        <div class="col-md-4 p-3">
            <h5>✔ Verified Sources</h5>
            <p>All news comes from trusted and verified reporters.</p>
        </div>

        <div class="col-md-4 p-3">
            <h5>✔ Easy to Use</h5>
            <p>Simple, clean, and user-friendly interface.</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center py-3 bg-light border-top">
    <small>© {{ date('Y') }} NewsPortal. All Rights Reserved.</small>
</footer>

</body>
</html>
