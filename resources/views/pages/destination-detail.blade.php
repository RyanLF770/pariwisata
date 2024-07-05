{{-- <!-- resources/views/pages/destination-detail.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Destination Detail</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>{{ $destination->title }}</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h4>Price: Rp. {{ $destination->price }}</h4>
                <p>{{ $destination->description }}</p>
                <a href="#" class="btn btn-primary">Submit</a>
            </div>
        </div>
        <a href="{{ route('destination.management') }}" class="btn btn-secondary mt-3">Back</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> --}}

<!-- resources/views/pages/destination-detail.blade.php -->

<!-- resources/views/pages/destination-detail.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Destination Detail</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>{{ $destination->title }}</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h4>Price: Rp. {{ $destination->price }}</h4>
                <p>{{ $destination->description }}</p>
                <a href="{{ route('booking.create', $destination->id) }}" class="btn btn-primary">Book Ticket</a>
                <div class="mt-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.9631641650293!2d-122.08424968468135!3d37.4220659798269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5e9f7e32797%3A0x2ec2c3fd7d9dbd5!2sGoogleplex!5e0!3m2!1sen!2sus!4v1620437104245!5m2!1sen!2sus"
                        width="100%"
                        height="250"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h3>Ratings</h3>
            @foreach($destination->ratings as $rating)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rating: {{ $rating->rating }}</h5>
                        <p class="card-text">{{ $rating->comment }}</p>
                        <p class="card-text"><small class="text-muted">Submitted on {{ $rating->created_at->format('d M Y') }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5">
            <h3>Add a Rating</h3>
            <form action="{{ route('destination.addRating', $destination->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating" class="form-control">
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Rating</button>
            </form>
        </div>
        <a href="{{ route('destination.management') }}" class="btn btn-secondary mt-3">Back</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

