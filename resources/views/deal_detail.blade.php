@include('navbar')

<ul style="list-style-type: none;">
    @if($deal)
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
            {{ $deal->name }}
           <br/>
        </li>
    @else
        This deal does not exist.
    @endif
</ul>