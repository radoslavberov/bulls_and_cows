@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card" id="play">
                    <div class="card-body">
                        <h3 class="card-title text-center">Guess the 4-digit number!</h3>
                        <h5>Attempts: <span id="attempts-count">{{ session('attempts', 0) }}</span></h5>
                        <form action="{{ route('game.guess') }}" method="POST" id="guess-form">
                            @csrf
                            <div class="form-group">
                                <label for="guess">Enter your guess:</label>
                                <input type="text" class="form-control" id="guess" name="guess" pattern="\d{4}"
                                       maxlength="4" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Guess</button>
                        </form>
                        <form action="{{ route('game.finish') }}" method="POST" id="give-up-form" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-warning">Give Up</button>
                        </form>

                        <div class="results-container mt-3">
                            <div id="guess-results"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <x-top-scores />
            </div>
        </div>
    </div>
@endsection

