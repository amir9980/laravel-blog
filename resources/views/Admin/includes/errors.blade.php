<div class="row">
    @foreach($errors->all() as $error)
        <p class="text-danger">{{$error}}</p>
    @endforeach
</div>
