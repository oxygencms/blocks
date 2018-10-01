@extends('oxygencms::admin.layout')

@section('title', 'Edit Block')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-center mb-3">
            <h1>Edit Block</h1>
        </div>
    </div>

    <form action="{{ route('block.update', $block) }}" method="POST">
        {!! csrf_field() !!}
        {!! method_field('patch') !!}

        @include('oxygencms::admin.blocks._form-fields')

        <button class="btn btn-primary" type="submit">Update</button>
    </form>

    @include('admin.partials.dropzone-uploads', ['uploadable' => $block])

@endsection