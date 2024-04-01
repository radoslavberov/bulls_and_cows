<div class="card">
    <div class="card-body">
        <h5 class="card-title">Top Scores</h5>
        @foreach($topScores as $score)
            <div class="alert alert-primary">User: {{ $score['user']['email']}},
                Best Attempt: {{ $score['best_attempt'] }}</div>
        @endforeach
    </div>
</div>
