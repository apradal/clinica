<form action="" id="record-edit-form">
    <div class="row">
        <div class="col-12">
            <h4>{{__('Historia')}}</h4>
        </div>
        <div class="col-12 col-md-6">
            <label for="allergies">{{__('Alergias')}}:</label>
            <textarea id="allergies" name="allergies" readonly>{{$record['allergies']}}</textarea>
        </div>
        <div class="col-12 col-md-6">
            <label for="treatment">{{__('Tratamiento médico')}}:</label>
            <textarea id="treatment" name="treatment" readonly>{{$record['treatment']}}</textarea>
        </div>
    </div>
</form>