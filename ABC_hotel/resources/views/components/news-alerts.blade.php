@if($alerts->isEmpty())
    <div class="bg-blue-100 text-blue-800 p-4 rounded-lg">
        No news alerts at the moment. Stay tuned!
    </div>
@else
    <div class="space-y-4">
        @foreach($alerts as $alert)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
                <strong>{{ $alert->title }}</strong>
                <p>{{ $alert->message }}</p>
                <small>Published on: {{ $alert->created_at->format('F d, Y') }}</small>
            </div>
        @endforeach
    </div>
@endif
