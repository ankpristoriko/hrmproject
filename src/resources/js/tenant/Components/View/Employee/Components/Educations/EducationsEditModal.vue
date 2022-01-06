<template>
    <modal id="employee-education-modal"
           size="large"
           v-model="showModal"
           :title="generateModalTitle('education')"
           @submit="submit"
           :loading="loading"
           :preloader="preloader">
        <form ref="form"
              enctype="multipart/form-data"
              @submit.prevent="submitData">
            <div class="row">
                <div class="col-md-6">
                    <app-form-group-selectable
                        type="search-select"
                        :label="$t('education_level')"
                        list-value-field="name"
                        :chooseLabel="$t('education_level')"
                        v-model="formData.education_level"
                        :required="true"
                        :error-message="$errorMessage(errors, 'education_level')"
                        :fetch-url="`${TENANT_SELECTABLE_EDUCATION}`"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('education_field')"
                        :placeholder="$placeholder('education_field')"
                        v-model="formData.education_field"
                        :error-message="$errorMessage(errors, 'education_field')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group-selectable
                        type="search-select"
                        :label="$t('educational_institution')"
                        list-value-field="name"
                        :chooseLabel="$t('educational_institution')"
                        v-model="formData.educational_institution"
                        :required="true"
                        :error-message="$errorMessage(errors, 'educational_institution')"
                        :fetch-url="`${TENANT_SELECTABLE_EDUCATIONAL_INSTITUTION}`"
                        @input="selectedItem"
                    />
                </div>

                <div class="col-md-6">
                    <app-form-group
                        :label="$t('location')"
                        :placeholder="$placeholder('location')"
                        v-model="formData.location"
                        :error-message="$errorMessage(errors, 'location')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('educational_institution_detail')"
                        :placeholder="$placeholder('educational_institution_detail')"
                        v-model="formData.educational_institution_detail"
                        :error-message="$errorMessage(errors, 'educational_institution_detail')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        type="number"
                        :label="$t('start_year')"
                        :placeholder="$placeholder('start_year')"
                        v-model="formData.start_year"
                        :required="true"
                        :error-message="$errorMessage(errors, 'start_year')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        type="number"
                        :label="$t('end_year')"
                        :placeholder="$placeholder('end_year')"
                        v-model="formData.end_year"
                        :error-message="$errorMessage(errors, 'end_year')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('grade_point_average')"
                        :placeholder="$placeholder('grade_point_average')"
                        v-model="formData.grade_point_average"
                        :required="true"
                        :error-message="$errorMessage(errors, 'grade_point_average')"
                    />
                </div>
               <div class="col-md-6">
                    <app-form-group
                        :label="$t('achievement')"
                        :placeholder="$placeholder('achievement')"
                        v-model="formData.achievement"
                        :required="true"
                        :error-message="$errorMessage(errors, 'achievement')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <app-form-group
                        :label="$t('remark')"
                        :placeholder="$placeholder('remark')"
                        v-model="formData.remark"
                        :required="true"
                        :error-message="$errorMessage(errors, 'remark')"
                    />
                </div>
            </div>

            <div class="form-group mb-0">
                <label>
                    {{ $t('attachments') }}
                </label>
                <app-input
                    type="dropzone"
                    v-model="attachments"
                    :error-message="errorMessageInArray(errors, 'attachments.0')"
                />
                <small class="text-muted">{{ $t('education_attachment_allowed_file_types') }}</small>
            </div>
        </form>
    </modal>
</template>
<script>

import ModalMixin from "../../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../../common/Mixin/Global/FormHelperMixins";
import {flatObjectWithKey} from "../../../../../../common/Helper/ObjectHelper";
import {TENANT_SELECTABLE_EDUCATIONAL_INSTITUTION, TENANT_SELECTABLE_EDUCATION} from "../../../../../../common/Config/apiUrl";
import {TENANT_BASE_URL} from '../../../../../../common/Config/UrlHelper';
import {axiosGet, axiosPost} from "../../../../../../common/Helper/AxiosHelper";
import {errorMessageInArray, formDataAssigner} from "../../../../../../common/Helper/Support/FormHelper";

export default {
    name: "EmployeeEducationEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: ['props', 'empId', 'educationId'],
    data() {
        return {
            TENANT_SELECTABLE_EDUCATIONAL_INSTITUTION,
            TENANT_SELECTABLE_EDUCATION,
            errorMessageInArray,
            formData: {
                location: '',
                education_level: '',
                educational_institution: '',
            },
            attachments: [],
            errors: {},
            preloader: false,
        }
    },
    methods: {
        submit() {
            this.loading = true;
            let formData = {...this.formData}
            formData = formDataAssigner(new FormData, formData);
                
            this.attachments.forEach(file => {
                formData.append('attachments[]', file)
            })

            formData.append('employee_id', this.empId)
            formData.append('education_id', this.educationId)
            formData.append('type', 'employee_educations')

            axiosPost(this.apiUrl.EMPLOYEE_EDUCATION, formData).then(({data}) => {
                this.loading = false;
                this.$toastr.s('', data.message);
                $('#employee-education-modal').modal('hide');
                this.$emit('reload')
            }).catch(({response}) => {
                this.loading = false;
                this.message = '';
                this.errors = response.data.errors || {};
                this.fieldStatus.isSubmit = true
                if (response.status != 422)
                    this.$toastr.e(response.data.message || response.statusText)
            })
        },
        afterSuccess({data}) {
            this.loading = false;
            $('#employee-education-modal').modal('hide');
            this.$toastr.s('', data.message);
            this.$emit('reload')
        },
        afterSuccessFromGetEditData({data}) {
            this.preloader = false;
            this.formData = data;
            this.formData = flatObjectWithKey(this.formData, 'value');
        },
        selectedItem(event) {
            axiosGet(`${TENANT_BASE_URL}/${this.getUrl}/${event}`).then(response => {
                this.formData.location = response.data.address;
            })
        }
    },
    computed: {
        getUrl() {
            return `${this.apiUrl.EDUCATIONAL_INSTITUTIONS}`;
        }
    }
}
</script>