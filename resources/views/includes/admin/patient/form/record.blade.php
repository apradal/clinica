<form action="{{route('patient.record.edit.ajax')}}" id="record-edit-form" method="post">
    <div class="row">
        <div class="col-12">
            <h4>{{__('Historia')}}</h4>
            <div class="alert-success"></div>
            <div class="alert-danger"></div>
        </div>
        <div class="col-12 col-md-6" id="allergies-editable">
            <label for="allergies">{{__('Alergias')}}:</label>
            <textarea id="allergies" name="allergies" readonly data-focus="true">{{$record['allergies']}}</textarea>
            <span class="edit-icon" data-target="allergies-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="treatment-editable">
            <label for="treatment">{{__('Tratamiento médico')}}:</label>
            <textarea id="treatment" name="treatment" readonly data-focus="true">{{$record['treatment']}}</textarea>
            <span class="edit-icon" data-target="treatment-editable">edit</span>
        </div>
        <div class="col-12">
            <input type="hidden" name="id" value="{{$record['id']}}" />
            <input type="hidden" name="patient_id" value="{{$patient['id']}}" />
            <button type="submit" class="hidden">{{__('Guardar')}}</button>
        </div>
    </div>
</form>