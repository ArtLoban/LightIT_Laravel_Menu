<!-- Message block -->
@if(session()->has('msg'))
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="alert alert-success">
                    {{ session('msg') }}
                </div>
            </div>
        </div>
    </div>
@endif
<!-- /.Message block -->