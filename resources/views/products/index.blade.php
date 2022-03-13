<h1>Index Products</h1>

<h4>Productos 1</h4>
@foreach ($productos as $item)
    <ul>
        <li>{{$item}}</li>
    </ul>
@endforeach

<h4>Productos 2</h4>
@foreach ($productos2 as $item)
    <ul>
        <li>{{$item}}</li>
    </ul>
@endforeach