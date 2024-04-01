<div class="card">
    <div class="card-body">
        <h5 class="card-title">Top Scores</h5>
        @if(count($topScores) > 0)
            @foreach($topScores as $score)
                <div class="alert alert-primary">User: {{ $score['user']['email']}},
                    Best Attempt: {{ $score['best_attempt'] }}</div>
            @endforeach
        @else
            <div class="alert alert-info">No Top Scores Yet! Be The First At The Top!</div>
        @endif
    </div>
</div>
