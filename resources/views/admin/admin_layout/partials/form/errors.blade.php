@if ($errors->any())
    <div class="alert-danger-container">
        <ul>
            @foreach($errors->all() as $error)
                <li>{!!$error!!}</li>
            @endforeach
        </ul>
    </div>
@endif
