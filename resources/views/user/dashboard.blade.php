<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsPortal - Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        .news-card {
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .news-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light px-3 border-bottom sticky-top">
    <span class="navbar-brand mb-0 h1 fw-bold">
        <i class="fas fa-newspaper text-primary"></i> NewsPortal
    </span>

    <div>
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="fas fa-tachometer-alt"></i> Admin Panel
                </a>
            @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="fas fa-newspaper"></i> My Dashboard
                </a>
            @endif
            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        @else
            <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
            <a href="{{ route('register.form') }}" class="btn btn-primary btn-sm">Sign Up</a>
        @endauth
    </div>
</nav>

<!-- Hero Section -->
<section class="hero text-center">
    <h1 class="display-5 fw-bold">Stay Updated with Fresh News</h1>
    <p class="lead">Breaking stories, local coverage, and world news — all in one place.</p>
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-lg mt-3">
                <i class="fas fa-tachometer-alt"></i> Go to Admin Panel
            </a>
        @else
            <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-lg mt-3">
                <i class="fas fa-newspaper"></i> Go to Dashboard
            </a>
        @endif
    @else
        <a href="#latest-news" class="btn btn-light btn-lg mt-3">
            <i class="fas fa-arrow-down"></i> Explore News
        </a>
    @endauth
</section>
<!-- Latest News Section -->
<section class="container my-5" id="latest-news">
    <h3 class="text-center section-title">
        <i class="fas fa-fire text-danger"></i> Latest News
    </h3>

    @if($news->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">No news articles yet</h5>
            <p class="text-muted">Check back soon for updates!</p>
        </div>
    @else
        <div class="row">
            @foreach($news as $newsItem)
            <div class="col-md-4 mb-4">
                <div class="card news-card">
                    <div class="position-relative">
                        @if($newsItem->category)
                            <span class="badge bg-primary category-badge">{{ $newsItem->category }}</span>
                        @endif

                        @if($newsItem->image)
                            <img src="{{ asset('storage/' . $newsItem->image) }}"
                                 class="card-img-top news-image"
                                 alt="{{ $newsItem->title }}">
                        @else
                            <div class="news-image bg-secondary d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-3x text-white"></i>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($newsItem->title, 50) }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($newsItem->content, 100) }}</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-user"></i> {{ $newsItem->user->name ?? 'Admin' }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $newsItem->created_at->diffForHumans() }}
                            </small>
                        </div>

                        @auth
                            <button
                                class="btn btn-primary btn-sm w-100 mt-3"
                                data-bs-toggle="modal"
                                data-bs-target="#newsModal{{ $newsItem->id }}">
                                <i class="fas fa-book-open"></i> Read More
                            </button>
                        @else
                            <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-sm w-100 mt-3">
                                <i class="fas fa-lock"></i> Login to Read Full Article
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            @auth
            <!-- News Detail Modal (Only for logged-in users) -->
            <div class="modal fade" id="newsModal{{ $newsItem->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $newsItem->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @if($newsItem->image)
                                <img src="{{ asset('storage/' . $newsItem->image) }}"
                                     class="img-fluid rounded mb-3 w-100"
                                     alt="{{ $newsItem->title }}">
                            @endif

                            <div class="mb-3">
                                @if($newsItem->category)
                                    <span class="badge bg-primary">{{ $newsItem->category }}</span>
                                @endif
                                <span class="badge bg-secondary">
                                    <i class="fas fa-user"></i> {{ $newsItem->user->name ?? 'Admin' }}
                                </span>
                                <span class="badge bg-info">
                                    <i class="fas fa-calendar"></i> {{ $newsItem->created_at->format('M d, Y') }}
                                </span>
                            </div>

                            <div class="content" style="white-space: pre-line; line-height: 1.8;">
                                {{ $newsItem->content }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
            @endforeach
        </div>

        <!-- Pagination Links -->
        @if($news->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            @auth
                @if(Auth::user()->role === 'user')
                    <p class="text-muted">
                        <i class="fas fa-info-circle"></i>
                        Showing {{ $news->firstItem() ?? 0 }} to {{ $news->lastItem() ?? 0 }}
                        of {{ $news->total() }} articles
                    </p>
                @endif
            @else
                <a href="{{ route('register.form') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Sign Up to See More
                </a>
            @endauth
        </div>
    @endif
</section>

<!-- Features Section -->
<section class="container my-5 bg-light py-5">
    <h3 class="text-center section-title">Why Choose NewsPortal?</h3>

    <div class="row text-center">
        <div class="col-md-4 p-3">
            <i class="fas fa-bolt fa-3x text-primary mb-3"></i>
            <h5>✔ Fast & Reliable</h5>
            <p>Get real-time updates as news breaks around you.</p>
        </div>

        <div class="col-md-4 p-3">
            <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
            <h5>✔ Verified Sources</h5>
            <p>All news comes from trusted and verified reporters.</p>
        </div>

        <div class="col-md-4 p-3">
            <i class="fas fa-heart fa-3x text-danger mb-3"></i>
            <h5>✔ Easy to Use</h5>
            <p>Simple, clean, and user-friendly interface.</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
@guest
<section class="container my-5 text-center">
    <div class="card bg-primary text-white p-5">
        <h2 class="fw-bold mb-3">Ready to Stay Informed?</h2>
        <p class="lead mb-4">Join thousands of readers who trust NewsPortal for their daily news</p>
        <div>
            <a href="{{ route('register.form') }}" class="btn btn-light btn-lg me-2">
                <i class="fas fa-user-plus"></i> Sign Up Free
            </a>
            <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </div>
</section>
@endguest

<!-- Footer -->
<footer class="text-center py-4 bg-dark text-white mt-5">
    <div class="container">
        <p class="mb-2">
            <i class="fas fa-newspaper"></i> <strong>NewsPortal</strong> - Your Trusted News Source
        </p>
        <small>© {{ date('Y') }} NewsPortal. All Rights Reserved.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
