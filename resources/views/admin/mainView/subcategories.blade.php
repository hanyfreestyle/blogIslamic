@foreach ($subcategories as $sub)
    <option value="{{ $sub->id }}" @if ($sub->id == $sendvalue) selected @endif >{{ $parent}} > {{ $sub->name }}</option>
    @if (count($sub->children) > 0)
        @php
            $parents = $parent . ' > ' . $sub->name;
        @endphp
        @include('admin.mainView.subcategories', ['subcategories' => $sub->children, 'parent' => $parents])
    @endif
@endforeach
