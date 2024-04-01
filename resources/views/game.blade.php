@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-title custom-header text-center">Guess the 4-digit number!</div>
                        <h6>Attempts: <span id="attempts-count">{{ session('attempts', 0) }}</span></h6>
                        <form action="{{ route('game.guess') }}" method="POST" id="guess-form">
                            @csrf
                            <div class="form-group custom-form-group">
                                <label for="guess">Enter your guess:</label>
                                <input type="text" class="form-control" id="guess"
                                       name="guess" pattern="\d{4}" maxlength="4" required>
                                <div id="guess-errors" class="alert alert-danger mt-3" style="display: none;"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-block custom-button">Submit Guess
                            </button>
                        </form>
                        <form action="{{ route('game.finish') }}" method="POST" id="give-up-form" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-md btn-block custom-button">Give Up
                            </button>
                        </form>

                        <form action="{{ route('game.start-new') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-md btn-block custom-button">Start New
                                Game
                            </button>
                        </form>
                        <div class="results-container mt-3">
                            <div id="guess-results"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <x-top-scores/>
                <!-- User scores display -->
                <div class="card mt-3 users-scores">
                    <div class="card-body">
                        <div class="card-title custom-header text-center">Your Scores</div>
                        @if(count($userScores) > 0)
                            @foreach($userScores as $score)
                                <div class="alert alert-primary">Game ID: {{ $score['id'] }},
                                    Attempts: {{ $score['attempts'] }}</div>
                            @endforeach
                        @else
                            <div class="alert alert-info">You haven't completed any games yet.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

