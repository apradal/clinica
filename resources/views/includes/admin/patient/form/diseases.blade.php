<form action="{{route('patient.disease.edit.ajax')}}" method="post" id="diseases-edit-form">
    <div class="row">
        <div class="col-12">
            <h4>{{__('Enfermedades')}}</h4>
            <div class="alert-success"></div>
            <div class="alert-danger"></div>
        </div>
        <div class="col-12 col-md-6" id="heart-editable">
            <label for="heart">{{__('Corazón')}}:</label>
            <select disabled name="heart" id="heart">
                <option {{$diseases['heart'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['heart'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="heart_description" readonly data-focus="true" id="heart_description">{{ $diseases['heart_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="heart-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="osteoporosis-editable">
            <label for="osteoporosis">{{__('Osteoporosis')}}:</label>
            <select disabled name="osteoporosis" id="osteoporosis">
                <option {{$diseases['osteoporosis'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['osteoporosis'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="osteoporosis_description" readonly data-focus="true" id="osteoporosis_description">{{ $diseases['osteoporosis_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="osteoporosis-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="liver-editable">
            <label for="liver">{{__('Hígado')}}:</label>
            <select disabled name="liver" id="liver">
                <option {{$diseases['liver'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['liver'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="liver_description" readonly data-focus="true" id="liver_description">{{ $diseases['liver_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="liver-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="cancer-editable">
            <label for="cancer">{{__('Cancer')}}:</label>
            <select disabled name="cancer" id="cancer">
                <option {{$diseases['cancer'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['cancer'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="cancer_description" readonly data-focus="true" id="cancer_description">{{ $diseases['cancer_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="cancer-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="kidney-editable">
            <label for="kidney">{{__('Riñón')}}:</label>
            <select disabled name="kidney" id="kidney">
                <option {{$diseases['kidney'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['kidney'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="kidney_description" readonly data-focus="true" id="kidney_description">{{ $diseases['kidney_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="kidney-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="hiv-editable">
            <label for="hiv">{{__('IVH')}}:</label>
            <select disabled name="hiv" id="hiv">
                <option {{$diseases['hiv'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['hiv'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="hiv_description" readonly data-focus="true" id="hiv_description">{{ $diseases['hiv_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="hiv-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="lung-editable">
            <label for="lung">{{__('Pulmón')}}:</label>
            <select disabled name="lung" id="lung">
                <option {{$diseases['lung'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['lung'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="lung_description" readonly data-focus="true" id="lung_description">{{ $diseases['lung_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="lung-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="hepatitis-editable">
            <label for="hepatitis">{{__('Hepatitis')}}:</label>
            <label for="hepatitis_a">A</label>
            <input type="radio" id="hepatitis_a" name="hepatitis_description" value="a" disabled {{$diseases['hepatitis_description'] == 'a' ? 'checked' : ''}}/>
            <label for="hepatitis_b">B</label>
            <input type="radio" id="hepatitis_b" name="hepatitis_description" value="b" disabled {{$diseases['hepatitis_description'] == 'b' ? 'checked' : ''}}/>
            <label for="hepatitis_c">C</label>
            <input type="radio" id="hepatitis_c" name="hepatitis_description" value="c" disabled {{$diseases['hepatitis_description'] == 'c' ? 'checked' : ''}}/>
            <span class="edit-icon" data-target="hepatitis-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="diabetes-editable">
            <label for="diabetes">{{__('Diabetes')}}:</label>
            <select disabled name="diabetes" id="diabetes">
                <option {{$diseases['diabetes'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['diabetes'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="diabetes_description" readonly data-focus="true" id="diabetes_description">{{ $diseases['diabetes_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="diabetes-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="circulatory-editable">
            <label for="circulatory">{{__('Circulatorio')}}:</label>
            <select disabled name="circulatory" id="circulatory">
                <option {{$diseases['circulatory'] == '1' ? 'selected' : ''}} value="1">
                    {{__('Si')}}
                </option>
                <option {{$diseases['circulatory'] == '1' ? '' : 'selected'}} value="0">
                    {{__('No')}}
                </option>
            </select>
            <textarea name="circulatory_description" readonly data-focus="true" id="circulatory_description">{{ $diseases['circulatory_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="circulatory-editable">edit</span>
        </div>
        <div class="col-12 col-md-6" id="others-editable">
            <label for="others_description">{{__('Otros')}}:</label>
            <textarea name="others_description" readonly data-focus="true" id="others_description">{{ $diseases['others_description'] ?? '' }}</textarea>
            <span class="edit-icon" data-target="others-editable">edit</span>
        </div>
        <div class="col-12">
            <input type="hidden" name="id" value="{{$diseases['id']}}" />
            <input type="hidden" name="record_id" value="{{$record['id']}}" />
            <button type="submit" class="hidden">{{__('Guardar')}}</button>
        </div>
    </div>
</form>