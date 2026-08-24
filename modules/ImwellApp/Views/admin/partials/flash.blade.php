@if(session('success'))
    <div class="row"><div class="col-12">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div></div>
@endif

@if(session('error'))
    <div class="row"><div class="col-12">
        <div class="alert alert-danger">{{ session('error') }}</div>
    </div></div>
@endif

@if($errors->any())
    <div class="row"><div class="col-12">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div></div>
@endif
