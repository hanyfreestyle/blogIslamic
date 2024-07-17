<div class="col-lg-12 mb-3">
    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Config.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="Config" :bg="puzzleMenu('Config',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Data.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="Data" :bg="puzzleMenu('Data',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Leads.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="Leads" :bg="puzzleMenu('Leads',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Model.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="Model" :bg="puzzleMenu('Model',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Product.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="Product" :bg="puzzleMenu('Product',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Crm.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="Crm" :bg="puzzleMenu('Crm',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.AppCore.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                print-lable="App Core" :bg="puzzleMenu('AppCore',$selRoute)"/>

</div>

