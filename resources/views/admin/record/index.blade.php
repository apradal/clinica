@extends('layouts\admin.app')
@section('body_class', 'admin_record_index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="xs-col-12">
                <h1>{{__('record/index.New Record')}}</h1>
                @if ($errors->any())
                    <!-- Messages -->
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="form-container">
                    <form method="POST" action="{{route('record.save')}}">
                        @csrf

                        <fieldset>
                            <legend>{{__('record/index.Personal Data')}}</legend>
                            <div>
                                <label for="name">{{__('record/index.Name')}}:</label>
                                <input type="text" name="name" id="name" value="{{ $name ?? '' }}"/>
                                <label for="surname">{{__('record/index.Surname')}}:</label>
                                <input type="text" name="surname" id="surname" value="{{ $surname ?? '' }}"/>
                                <label for="nif">{{__('record/index.Nif')}}:</label>
                                <input type="text" name="nif" id="nif" value="{{ $nif ?? '' }}"/>
                            </div>
                            <div>
                                <label for="email">{{__('record/index.Email')}}:</label>
                                <input type="email" name="email" id="email" value="{{ $email ?? '' }}"/>
                                <label for="address">{{__('record/index.Address')}}:</label>
                                <input type="text" name="address" id="address" value="{{ $address ?? '' }}"/>
                                <label for="phone">{{__('record/index.Phone')}}:</label>
                                <input type="number" name="phone" id="phone" value="{{ $phone ?? '' }}"/>
                            </div>
                            <div>
                                <label for="phone2">{{__('record/index.Phone 2')}}:</label>
                                <input type="number" name="phone2" id="phone2" value="{{ $phone2 ?? '' }}"/>
                                <label for="birth_year">{{__('record/index.BirthDay')}}</label>
                                <input type="date" id="birth_year" name="birth_year" value="{{ $birth_year ?? '' }}"/>
                                <label for="insurance">{{__('record/index.Insurance')}}:</label>
                                <textarea name="insurance" id="insurance">{{ $insurance ?? '' }}</textarea>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>{{__('record/index.Record')}}</legend>
                            <div>
                                <label for="allergies">{{__('record/index.Do you have any allergies?')}}:</label>
                                <textarea name="allergies" id="allergies">{{ $allergies ?? '' }}</textarea>
                                <label for="treatment">{{__('record/index.Are you under medical treatment?')}}:</label>
                                <textarea name="treatment" id="treatment">{{ $treatment ?? '' }}</textarea>
                            </div>
                            <div>
                                <p>{{__('record/index.Do you have any disease?')}}:</p>
                                <div>
                                    <label for="heart">{{__('record/index.Heart')}}:</label>
                                    <select name="heart" id="heart">
                                        <option {{(isset($heart) && $heart) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($heart) && $heart) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="heart_description" id="heart_description">{{ $heart_description ?? '' }}</textarea>
                                    <label for="osteoporosis">{{__('record/index.Osteoporosis')}}:</label>
                                    <select name="osteoporosis" id="osteoporosis">
                                        <option {{(isset($osteoporosis) && $osteoporosis) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($osteoporosis) && $osteoporosis) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="osteoporosis_description" id="osteoporosis_description">{{ $osteoporosis_description ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="liver">{{__('record/index.Liver')}}:</label>
                                    <select name="liver" id="liver">
                                        <option {{(isset($liver) && $liver) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($liver) && $liver) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="liver_description" id="liver_description">{{ $liver_description ?? '' }}</textarea>
                                    <label for="cancer">{{__('record/index.Cancer')}}:</label>
                                    <select name="cancer" id="cancer">
                                        <option {{(isset($cancer) && $cancer) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($cancer) && $cancer) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="cancer_description" id="cancer_description">{{ $cancer_description ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="kidney">{{__('record/index.Kidney')}}:</label>
                                    <select name="kidney" id="kidney">
                                        <option {{(isset($kidney) && $kidney) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($kidney) && $kidney) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="kidney_description" id="kidney_description">{{ $kidney_description ?? '' }}</textarea>
                                    <label for="hiv">{{__('record/index.HIV')}}:</label>
                                    <select name="hiv" id="hiv">
                                        <option {{(isset($hiv) && $hiv) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($hiv) && $hiv) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="hiv_description" id="hiv_description">{{ $hiv_description ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="lung">{{__('record/index.Lung')}}:</label>
                                    <select name="lung" id="lung">
                                        <option {{(isset($lung) && $lung) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($lung) && $lung) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="lung_description" id="lung_description">{{ $lung_description ?? '' }}</textarea>
                                    <label for="disease_hepatitis">{{__('record/index.Hepatitis')}}:</label>
                                    <label for="hepatitis_a">A</label>
                                    <input type="radio" id="hepatitis_a" name="hepatitis_description" value="a" {{(isset($hepatitis_description) && $hepatitis_description == 'a') ? 'checked' : ''}}/>
                                    <label for="hepatitis_b">B</label>
                                    <input type="radio" id="hepatitis_b" name="hepatitis_description" value="b" {{(isset($hepatitis_description) && $hepatitis_description == 'b') ? 'checked' : ''}}/>
                                    <label for="hepatitis_c">C</label>
                                    <input type="radio" id="hepatitis_c" name="hepatitis_description" value="c" {{(isset($hepatitis_description) && $hepatitis_description == 'c') ? 'checked' : ''}}/>
                                </div>
                                <div>
                                    <label for="diabetes">{{__('record/index.Diabetes')}}:</label>
                                    <select name="diabetes" id="diabetes">
                                        <option {{(isset($diabetes) && $diabetes) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($diabetes) && $diabetes) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="diabetes_description" id="diabetes_description">{{ $diabetes_description ?? '' }}</textarea>
                                    <label for="circulatory">{{__('record/index.Circulatory')}}:</label>
                                    <select name="circulatory" id="circulatory">
                                        <option {{(isset($circulatory) && $circulatory) == '1' ? 'selected' : ''}} value="1">
                                            {{__('record/index.Yes')}}
                                        </option>
                                        <option {{(isset($circulatory) && $circulatory) == '1' ? '' : 'selected'}} value="0">
                                            {{__('No')}}
                                        </option>
                                    </select>
                                    <textarea name="circulatory_description" id="circulatory_description">{{ $circulatory_description ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="others_description">{{__('record/index.Others')}}:</label>
                                    <textarea name="others_description" id="others_description">{{ $others_description ?? '' }}</textarea>
                                </div>
                            </div>
                        </fieldset>

                        <input type="submit" value="{{__('record/index.Save')}}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection