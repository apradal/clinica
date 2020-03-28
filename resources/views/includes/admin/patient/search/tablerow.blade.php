@foreach($result as $data)
    <tr>
        <th scope="row">{{$data->name}}</th>
        <td>{{$data->surname}}</td>
        <td>{{$data->nif}}</td>
        <td>{{$data->email}}</td>
        <td>{{$data->phone}}</td>
        <td>
            <form action="{{route('patient')}}" method="get">
                <input type="hidden" name="id" value="{{$data->id}}">
                <button type="submit">{{__('Ir a Historia')}}</button>
            </form>
        </td>
    </tr>
@endforeach