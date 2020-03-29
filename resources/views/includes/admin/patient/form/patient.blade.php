<form action="{{route('patient.edit.ajax')}}" method="post" id="patient-edit-form">
    <div class="row">
        <div class="col-12">
            <h4>{{__('Datos Personales')}}</h4>
            <div class="alert-success"></div>
            <div class="alert-danger"></div>
        </div>
        <div class="col-12 col-md-6">
            <label for="email">{{__('Email')}}:</label>
            <input type="text" id="email" name="email" readonly value="{{$patient['email']}}"/>
            <span class="edit-icon" data-target="email">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <label for="birth_year">{{__('Fecha de nacimiento')}}:</label>
            <input type="date" id="birth_year" name="birth_year" readonly value="{{$patient['birth_year']}}"/>
            <span class="edit-icon" data-target="birth_year">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <label for="phone">{{__('Teléfono')}}:</label>
            <input type="text" id="phone" name="phone" readonly value="{{$patient['phone']}}"/>
            <span class="edit-icon" data-target="phone">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <label for="phone2">{{__('Teléfono 2')}}:</label>
            <input type="text" id="phone2" name="phone2" readonly value="{{$patient['phone2']}}"/>
            <span class="edit-icon" data-target="phone2">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <label for="address">{{__('Dirección')}}:</label>
            <textarea id="address" name="address" readonly>{{$patient['address']}}</textarea>
            <span class="edit-icon" data-target="address">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <label for="insurance">{{__('Aseguradora')}}:</label>
            <textarea id="insurance" name="insurance" readonly>{{$patient['insurance']}}</textarea>
            <span class="edit-icon" data-target="insurance">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <input type="hidden" name="id" value="{{$patient['id']}}" />
            <button type="submit" class="hidden">{{__('Guardar')}}</button>
        </div>
    </div>
</form>