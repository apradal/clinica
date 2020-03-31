<form action="{{route('patient.edit.ajax')}}" method="post" id="patient-edit-form">
    <div class="row">
        <div class="col-12">
            <h4>{{__('Datos Personales')}}</h4>
            <div class="alert-success"></div>
            <div class="alert-danger"></div>
        </div>
        <div class="col-12 col-md-6" id="email-editable">
            <label for="email">{{__('Email')}}:</label>
            <input type="text" id="email" name="email" readonly value="{{$patient['email']}}" data-focus="true"/>
            <span class="edit-icon" data-target="email-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="birth_year-editable">
            <label for="birth_year">{{__('Fecha de nacimiento')}}:</label>
            <input type="date" id="birth_year" name="birth_year" readonly value="{{$patient['birth_year']}}" data-focus="true"/>
            <span class="edit-icon" data-target="birth_year-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="phone-editable">
            <label for="phone">{{__('Teléfono')}}:</label>
            <input type="text" id="phone" name="phone" readonly value="{{$patient['phone']}}" data-focus="true"/>
            <span class="edit-icon" data-target="phone-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="phone2-editable">
            <label for="phone2">{{__('Teléfono 2')}}:</label>
            <input type="text" id="phone2" name="phone2" readonly value="{{$patient['phone2']}}" data-focus="true"/>
            <span class="edit-icon" data-target="phone2-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="address-editable">
            <label for="address">{{__('Dirección')}}:</label>
            <textarea id="address" name="address" readonly data-focus="true">{{$patient['address']}}</textarea>
            <span class="edit-icon" data-target="address-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="insurance-editable">
            <label for="insurance">{{__('Aseguradora')}}:</label>
            <textarea id="insurance" name="insurance" readonly data-focus="true">{{$patient['insurance']}}</textarea>
            <span class="edit-icon" data-target="insurance-editable">edit</span>
        </div>
        <div class="col-12 col-md-6">
            <input type="hidden" name="id" value="{{$patient['id']}}" />
            <button type="submit" class="hidden">{{__('Guardar')}}</button>
        </div>
    </div>
</form>