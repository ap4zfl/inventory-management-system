
@include('manager.header')
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
        <h1>Welcome, {{ session('manager')->username }}</h1>
        <div class="row g-4 mt-5">
            <!-- Products Card -->
            <div class="col-md-4">
                <a href="{{ url('manager-products') }}" class="card-link">
                    <div class="card text-center border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <p class="card-text display-5">{{ $productsCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
    </div>

@include('manager.footer')

