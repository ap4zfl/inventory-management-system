
@include('admin.header')
<style>
    .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        a.card-link {
            text-decoration: none;
            color: inherit;
        }
</style>
    <div class="col-md-12 p-5">
        <h1>Welcome, {{ session('admin')->username }}</h1>
        <div class="row g-4 justify-content-center mt-5">


            <!-- Users Card -->
            <div class="col-md-4">
                <a href="{{ url('view-users') }}" class="card-link">
                    <div class="card text-center border-success">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text display-5">{{ $usersCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Products Card -->
            <div class="col-md-4">
                <a href="{{ url('all-product') }}" class="card-link">
                    <div class="card text-center border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p class="card-text display-5">{{ $productsCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Orders Card -->
            <div class="col-md-4">
                <a href="{{ url('orders') }}" class="card-link">
                    <div class="card text-center border-warning">
                        <div class="card-body">
                            <h5 class="card-title">Orders</h5>
                            <p class="card-text display-5">{{ $ordersCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

@include('admin.footer')

