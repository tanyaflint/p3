@if($errors->get($field))
    <div class='text-danger'>
        <ul>
            @foreach($errors->get($field) as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif