@foreach ($subcategories as $sub)
    <option value="{{ $sub['path'] }}" @if ($sub['path'] == old('path',issetArr($_GET,'path',null)) ) selected @endif >{{ $parent}} > {{ $sub['name'] }}</option>
    @if (count($sub['children']) > 0)
        @php
            $parents = $parent . ' > ' . $sub->name;
        @endphp
        @include('AppPlugin.FileManager.subcategories', ['subcategories' => $sub->children, 'parent' => $parents])
    @endif
@endforeach
