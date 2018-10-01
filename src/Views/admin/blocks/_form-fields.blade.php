<div class="row">
    <!-- name -->
    <div class="form-group col-6">
        <label for="name">Name <strong>*</strong></label>
        <input type="text"
               class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
               id="name"
               name="name"
               placeholder="Enter bock name..."
               value="{{ old('name', optional($block)->name) }}"
        >
        {!! $errors->first('name', '<small class="form-text text-danger">:message</small>') !!}
    </div>
</div>


@foreach(config('app.locales') as $locale => $locale_name)
    <div class="row">
        <!-- body -->
        <div class="form-group col-12">
            <label for="{{ "body-$locale" }}">Body ({{ $locale }})</label>
            <textarea class="form-control"
                      id="{{ "body-$locale" }}"
                      name="{{ "body[$locale]" }}"
                      rows="11"
                      placeholder="Enter block body..."
            >{!! old("body.$locale", optional($block)->getTranslation('body', $locale)) !!}</textarea>
            {!! $errors->first("body.$locale", '<small class="form-text text-danger">:message</small>') !!}
        </div>
    </div>
@endforeach

@include('oxygencms::admin.partials.tinymce', ['selector' => '#body-en', 'model' => $block])