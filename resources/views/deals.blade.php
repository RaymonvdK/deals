@include('navbar')
@include('sorting')

<ul style="list-style-type: none;">
    @foreach($deals as $deal)
        <a href="deal/{{ $deal->unique }}">
            <li>
                <img src="https://media.socialdeal.nl{{ $deal->img }}" style="width: 300px;"/>
                <br/>
                {{ $deal->title }}
                <br/>
                {{ $deal->company_name }}
                <br/>
                {{ $deal->location }}
                <br/>
                Prijs: {{ $deal->price }}
                <br/>
                Verkocht: {{ $deal->sold }}
                <br/>
            </li>
        </a>
    @endforeach
</ul>