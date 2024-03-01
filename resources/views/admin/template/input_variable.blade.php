@if(isset($fieldDetails))
    @foreach($input_variables as $dat)
        @php
            $disabledClass = '';
            if(!in_array($dat->fields, $fieldDetails)) {

                $disabledClass = 'disabled';
            }

        @endphp
        <tr>
            <td>{{$dat->variable_name}}</td>
            <td>{{$dat->variable_type}}</td>
            <td>
                <!-- @if($dat->user_relation != 1) 
                    <a href="#" title="{{__('test.edit')}}" id="editDocumentVariable" class="btn btn-primary btn-rounded m-1 {{$disabledClass}}" data-id="{{$dat->id}}" data-variable-id="{{$dat->variable_id}}"  data-name="{{$dat->variable_name}}" data-type-id="{{$dat->variable_type_id}}" data-toggle="modal" data-target="#myModal" ><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a>
                @endif -->
                    <a href="#" title="{{__('test.edit')}}" id="editDocumentVariable" class="btn btn-primary btn-rounded m-1 {{$disabledClass}}" data-id="{{$dat->id}}" data-variable-id="{{$dat->variable_id}}"  data-name="{{$dat->variable_name}}" data-type-id="{{$dat->variable_type_id}}" data-toggle="modal" data-target="#myModal" ><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-rounded m-1 deleteDocumentVariable {{$disabledClass}}" data-id="{{ $dat->id }}"  title="{{__('test.delete')}}"><i style="font-size: 1.3rem;" class="i-Delete-File"></i></a>
            </td>
        </tr>
    @endforeach
@endif
