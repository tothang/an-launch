@foreach($questions as $question)
    <div class="question">
        {{ $question->question }}
        <p>{{ $question->from }}</p>

        <i class="fa fa-heart"></i>
    </div>
@endforeach
