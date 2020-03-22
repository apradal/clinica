<form action="" id="patient-edit-form">
    <div class="row">
        <div class="col-12">
            <h4>{{__('Datos Personales')}}</h4>
        </div>
        <div class="col-12 col-md-6">
            <label for="email">{{__('Email')}}:</label>
            <input type="text" id="email" name="email" readonly value="{{$patient['email']}}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="birth_year">{{__('Fecha de nacimiento')}}:</label>
            <input type="date" id="birth_year" name="birth_year" readonly value="{{$patient['birth_year']}}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="phone">{{__('Teléfono')}}:</label>
            <input type="text" id="phone" name="phone" readonly value="{{$patient['phone']}}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="phone2">{{__('Teléfono 2')}}:</label>
            <input type="text" id="phone2" name="phone2" readonly value="{{$patient['phone2']}}"/>
        </div>
        <div class="col-12 col-md-6">
            <label for="address">{{__('Dirección')}}:</label>
            <textarea id="address" name="address" readonly>{{$patient['address']}}</textarea>
        </div>
        <div class="col-12 col-md-6">
            <label for="insurance">{{__('Aseguradora')}}:</label>
            <textarea id="insurance" name="insurance" readonly>{{$patient['insurance']}}</textarea>
        </div>
    </div>
</form>