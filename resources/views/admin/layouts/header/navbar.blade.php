<nav class="navbar navbar-light bg-white border-bottom px-3">
    <span>Welcome, Admin</span>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm btn-danger">Logout</button>
    </form>
</nav>
