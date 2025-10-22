<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: #f8f9fa;
      padding: 100px 0;
      text-align: center;
    }
    .features {
      padding: 60px 0;
    }
    .cta {
      background-color: #0d6efd;
      color: white;
      padding: 60px 0;
      text-align: center;
    }
    .cta a.btn {
      background-color: white;
      color: #0d6efd;
      border: none;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="display-4">Welcome to Our Website</h1>
      <p class="lead">We provide solutions that help you grow your business.</p>
      <a href="javascript:void(0);" class="btn btn-primary btn-lg mt-3">Learn More</a>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="features">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4">
          <h3>Feature One</h3>
          <p>Short description of the feature. Explain why it matters.</p>
        </div>
        <div class="col-md-4">
          <h3>Feature Two</h3>
          <p>Short description of the feature. Highlight its benefits.</p>
        </div>
        <div class="col-md-4">
          <h3>Feature Three</h3>
          <p>Short description of the feature. Make it appealing.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta">
    <div class="container">
      <h2 class="mb-4">Login to Admin Dashboard?</h2>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-lg">Login</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center py-4">
    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
