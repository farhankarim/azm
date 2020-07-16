<div class="form-group row align-items-center" :class="{'has-danger': errors.has('fname'), 'has-success': fields.fname && fields.fname.valid }">
    <label for="fname" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.teacher.columns.fname') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.fname" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('fname'), 'form-control-success': fields.fname && fields.fname.valid}" id="fname" name="fname" placeholder="{{ trans('admin.teacher.columns.fname') }}">
        <div v-if="errors.has('fname')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fname') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('lname'), 'has-success': fields.lname && fields.lname.valid }">
    <label for="lname" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.teacher.columns.lname') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.lname" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('lname'), 'form-control-success': fields.lname && fields.lname.valid}" id="lname" name="lname" placeholder="{{ trans('admin.teacher.columns.lname') }}">
        <div v-if="errors.has('lname')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('lname') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('dob'), 'has-success': fields.dob && fields.dob.valid }">
    <label for="dob" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.teacher.columns.dob') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.dob" :config="datePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('dob'), 'form-control-success': fields.dob && fields.dob.valid}" id="dob" name="dob" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('dob')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('dob') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('enabled'), 'has-success': fields.enabled && fields.enabled.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="enabled" type="checkbox" v-model="form.enabled" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element">
        <label class="form-check-label" for="enabled">
            {{ trans('admin.teacher.columns.enabled') }}
        </label>
        <input type="hidden" name="enabled" :value="form.enabled">
        <div v-if="errors.has('enabled')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('enabled') }}</div>
    </div>
</div>


