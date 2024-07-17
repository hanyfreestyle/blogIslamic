@foreach($directories as $directory)
  @if(!in_array($directory['path'],$db_directories))
    <li role="treeitem" aria-expanded="false" aria-selected="false">
      <span aria-label="{{$directory['path']}}"> {{$directory['name']}}</span>
      @if(count($directory['children']) > 0)
        <ul role="group">
          @include('AppPlugin.FileManager.browser_tree_folder',['directories' =>$directory['children'] ,'db_directories'=> $db_directories] )
        </ul>
      @endif
    </li>
  @endif
@endforeach
