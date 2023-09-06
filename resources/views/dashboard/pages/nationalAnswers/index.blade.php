@extends('dashboard.layout.dashboard')


@section('content')
    <div class="tab-content padding-4">

        <div class="widget-toolbar">

            <div class="d-none d-md-block">


                <a href="{{ route('nationalAnswer.create') }}" class="btn btn-primary btn-xs"><i
                        class="ace-icon fa fa-plus"></i>Create</a>
                        <a href="{{ route('nationalAnswer.soft') }}" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o bigger-120"></i>RecycleBin
                        </a>

            </div>
        </div>

        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="100" class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>

                    <th width="100">Uuid</th>
                    
                    <th width="100">Answer</th>
                    <th width="100">Status</th>
                    <th width="100">Question</th>
                    <th width="130">Actions</th>

                </tr>
            <tbody>

                @foreach ($answers as $data)
                    <tr class="collageRow{{ $data->id }}">
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td>{{ $data->uuid }}</td>

                        <td>{{ $data->answer }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            {{ $data->NationalQuestion->question }}
                           
                
                    </td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons" style="display:flex;">

                                <a class="green" href="{{ route('nationalAnswer.edit', $data->uuid) }}">
                                    <i class="ace-icon fa fa-pencil bigger-120"> </i>
                                </a>
                                <a class="blue" href="{{ route('nationalAnswer.show', $data->uuid) }}">
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>
                                <form method="POST" action="{{ route('nationalAnswer.destroy', $data->uuid) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="red"><i class="ace-icon fa fa-trash-o bigger-120">
                                        </i></button>

                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach



            </tbody>
        </table>

    </div>

    </div>
@endsection
