/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/patient/patient.js":
/*!***********************************************!*\
  !*** ./resources/js/admin/patient/patient.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function Patient() {
  this.addBtnTreatment = $('#add-treatment-btn');
  this.treatmentTable = $('#treatment-table');
  this.ajaxMsgRow = $('#btn-row');
  this.editIcons = $('.edit-icon');
  this.forms = $('#patient-edit-form, .treatments-edit-form, #record-edit-form, #diseases-edit-form');

  this.init = function () {
    this._addBtnListeners();

    this._addFormListeners();
  };

  this._addBtnListeners = function () {
    var self = this; //Add Treatment button

    this.addBtnTreatment.on('click', function () {
      //print form
      if (!$(this).hasClass('submit')) {
        var formId = self._createDynamicTreatmentForm();

        $(this).addClass('submit');
        $(this).html('Guardar');
        $(this).attr('data-form-id', formId);
      } else if ($(this).hasClass('submit')) {
        $(this).attr('disabled', true);
        var form = $('#' + $(this).attr('data-form-id'));

        self._sendFormTreatmentAjax(form);
      }
    }); //Edit patient data icons

    this.editIcons.on('click', function () {
      var wrapper = $('#' + $(this).data('target'));
      var inputs = wrapper.find('input, textarea, select');
      var submit = $(this).closest('form').find('button[type="submit"]'); //iterate all inputs

      inputs.each(function (counter, elmt) {
        if ($(elmt).attr('readOnly')) $(elmt).attr('readOnly', false);
        if ($(elmt).attr('disabled')) $(elmt).attr('disabled', false);
        let type = $(elmt).attr('type');

        if (type !== 'radio') $(elmt).attr('data-changed', true);

        //set focus
        if ($(elmt).data('focus')) {
          $(elmt).focus();

          if (type !== 'date' || type !== 'radio') {
            var strLength = $(elmt).val().length * 2;
            $(elmt)[0].setSelectionRange(strLength, strLength);
          }
        }
      });
      if (submit.hasClass('hidden')) submit.removeClass('hidden');
    });
  };

  this._addFormListeners = function () {
    var self = this;

    this.forms.on('submit', function (e) {
      e.preventDefault();

      var data = self._getInputsModified($(this));

      var form = $(this);

      if (Object.keys(data).length) {
        self._editFormAjax(form, data, function (response) {
          if (response.success) {
            $.each(form.find(':input'), function () {
              if ($(this).attr('type') === 'submit') {
                return true;
              } else if ($(this).prop('type') === 'select-one') {
                $(this).attr('disabled', true);
              } else {
                $(this).attr('readonly', true);
              }
            });
            form.find('button[type="submit"]').addClass('hidden');
            var success = form.find('.alert-success');
            if (success.css('display') === 'none') success.css('display', '');
            success.html(response.message).delay(2000).fadeOut('slow');
          } else {
            form.find('.alert-danger').html(response.message).delay(2000).fadeOut('slow');
          }
        });
      }
    });
  };

  this._editFormAjax = function (form, data, successCallback, failCallback) {
    var self = this;
    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }).done(function (response) {
      successCallback(response);
    }).fail(function (response) {
      //todo show errors
      console.log('Error');
    });
  };

  this._createDynamicTreatmentForm = function () {
    var id = this.makeUniqueId(); //form

    var form = $('<form></form>');
    form.attr({
      'id': id,
      'action': 'patient/add-treatment-ajax',
      'method': 'POST'
    }); //row

    var row = $('<div></div>');
    row.attr({
      'class': 'tr',
      'id': 'row-' + id
    }); //inputs

    var patientInput = $('<input type="hidden" />');
    patientInput.attr({
      'name': 'patient-id',
      'value': this.treatmentTable.data('pacient-id')
    });
    var dateInput = $('<input type="date" />');
    dateInput.attr({
      'name': 'date',
      'class': 'td',
      'value': ''
    });
    var descriptionTextArea = $('<textarea></textarea>');
    descriptionTextArea.attr({
      'name': 'description',
      'class': 'td',
      'cols': '60',
      'rows': '2'
    });
    row.append([dateInput, descriptionTextArea, patientInput]);
    form.append(row);
    this.addBtnTreatment.before(form);
    return id;
  };

  this._sendFormTreatmentAjax = function (form) {
    this._readOnlyInputs(form, true);

    var self = this;
    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: form.serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }).done(function (response) {
      if (response.success) {
        self.addBtnTreatment.removeClass('submit');
        self.addBtnTreatment.html('Añadir');
        self.addBtnTreatment.attr('disabled', false);
        self.ajaxMsgRow.find('.alert-success').html('Tratamiento añadido');
        self.ajaxMsgRow.find('.alert-danger').html('');
      } else {
        self.ajaxMsgRow.find('.alert-danger').html('Error al añadir tratamiento');
        self.ajaxMsgRow.find('.alert-success').html('');
        self.addBtnTreatment.attr('disabled', false);

        self._readOnlyInputs(form, false);
      }
    }).fail(function (response) {
      self.ajaxMsgRow.find('.alert-danger').html('Error al añadir tratamiento');
      self.ajaxMsgRow.find('.alert-success').html('');
      self.addBtnTreatment.attr('disabled', false);

      self._readOnlyInputs(form, false);
    });
  };

  this._readOnlyInputs = function (form, $value) {
    var id = form.attr('id');
    $('#' + id + ' input, #' + id + ' textarea').each(function () {
      $(this).attr('readOnly', $value);
    });
  };

  this.makeUniqueId = function () {
    return Math.random().toString(36).substr(2, 9);
  };
  /**
   * Gets only the data from inputs modified.
   * @param form
   * @private
   */


  this._getInputsModified = function (form) {
    var data = {};
    $.each(form.find(':input'), function () {
      if ($(this).data('changed') || $(this).attr('type') === 'hidden' || $(this).is(':checked')) {
        data[$(this).attr('name')] = $(this).val();
      }
    });
    return data;
  };
}

$(document).ready(function () {
  new Patient().init();
});

/***/ }),

/***/ 1:
/*!*****************************************************!*\
  !*** multi ./resources/js/admin/patient/patient.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\gestion-clinica\resources\js\admin\patient\patient.js */"./resources/js/admin/patient/patient.js");


/***/ })

/******/ });