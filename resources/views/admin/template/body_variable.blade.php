
    @foreach($input_variables as $dat)
    <tr>
    <td data-field="{{$dat->fields}}" class="variable_name">{{$dat->variable_name}}</td>
    <td>
        <button class="btn btn-primary btn_button" type="button">Add</button>
    </td>
    </tr>
    @endforeach


