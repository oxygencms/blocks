@extends('oxygencms::admin.layout')

@section('title', 'Edit Block')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-center mb-3">
            <h1>Edit Block</h1>
        </div>
    </div>

    <form action="{{ route('admin.block.update', $block) }}" method="POST">
        {!! csrf_field() !!}
        {!! method_field('patch') !!}

        @include('oxygencms::admin.blocks._form-fields')

        <button class="btn btn-primary" type="submit">Update</button>
    </form>

    <media-uploads mediable_type="{{ get_class($block) }}"
                   mediable_id="{{ $block->id }}"
                   :media="{{ $block->media }}"
                   class="mt-3"
    ></media-uploads>

@endsection