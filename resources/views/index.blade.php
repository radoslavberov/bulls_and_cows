@extends('layouts.app')

@section('content')
    <<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-card">
                    <div class="card-header text-center custom-header">Welcome to Cows and Bulls!</div>

                    <div class="card-body">
                        <img src="bullcowkiss.gif" alt="Cows and Bulls" class="img-fluid mx-auto d-block" style="max-width: 300px;">

                        <form action="{{ route('game.start') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="form-group custom-form-group">
                                <label for="email" class="custom-label">Enter your email to start:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Start Game</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="top-players">
                    <div class="card-header text-center custom-header">Beat The Top Players</div>
                    <x-top-scores/>
                </div>
            </div>
        </div>
    </div>
@endsection
