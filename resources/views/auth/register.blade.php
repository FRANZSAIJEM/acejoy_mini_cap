@extends('base')

@section('content')
<div class="container p-5" style="max-width: 750px;">
    <div class="card shadow fish-card">
        <div class="card-header" style="background-color: #1E90FF; color: #FFF;">
            <h1 class="text-center fish-text"><i class="fas fa-fish"></i> Welcome to Fish Registration!</h1>
        </div>
        <div class="card-body" style="background-color: #00CED1;">
            <form action="{{ '/register' }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="fish-label">Fish Name</label>
                    <input type="text" name="name" id="name" class="form-control fish-input" placeholder="Your Fish Name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="fish-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control fish-input" placeholder="Your Fish Email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="fish-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control fish-input" placeholder="Your Fish Password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="fish-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control fish-input" placeholder="Your Fish Password">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex mt-5">
                    <div class="flex-grow-1">
                        <a href="{{ '/' }}" class="fish-link">Already swam in the sea? Login here</a>
                    </div>
                    <button class="btn btn-primary fish-button" style="background-color: #4682B4;">Swim and Register</button>
                </div>
            </form>
        </div>
    </div>


</div>

<style>
    /* Custom CSS for Futuristic Styling */

/* Card Styling */
.futuristic-card {
    background-color: #5b270f; /* Dark background color */
    border: none;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.1); /* Soft white glow */
    color: #FFFFFF; /* Text color */
}

/* Header Text Styling */
.futuristic-text {
    font-size: 24px; /* Larger font size */
    font-weight: bold;
    color: #dc4c77; /* Bright blue text color */
}

/* Form Label Styling */
.futuristic-label {
    font-size: 16px; /* Font size */
    color: #FFFFFF; /* Text color */
}

/* Form Input Styling */
.futuristic-input {
    background-color: #be9b00; /* Dark input background color */
    border: 1px solid #ff008c; /* Bright blue border */
    border-radius: 5px;
    color: #FFFFFF; /* Text color */
}

/* Form Input Focus Styling */
.futuristic-input:focus {
    outline: none;
    box-shadow: 0 0 5px #00BFFF; /* Bright blue box shadow on focus */
}

/* Link Styling */
.futuristic-link {
    color: #00BFFF; /* Bright blue link color */
    text-decoration: none;
}

/* Link Hover Styling */
.futuristic-link:hover {
    text-decoration: underline;
}

/* Button Styling */
.futuristic-button {
    background-color: #00BFFF; /* Bright blue button background color */
    color: #FFFFFF; /* Text color */
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

/* Button Hover Styling */
.futuristic-button:hover {
    background-color: #0073E6; /* Darker blue on hover */
}

</style>
@endsection
