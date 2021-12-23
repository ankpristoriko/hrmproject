<template>
    <modal id="employee-education-modal"
           size="large"
           v-model="showModal"
           :title="generateModalTitle('education')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form"
              :data-url="selectedUrl ? selectedUrl : url"
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
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('remark')"
                        :placeholder="$placeholder('remark')"
                        v-model="formData.remark"
                        :required="true"
                        :error-message="$errorMessage(errors, 'remark')"
                    />
                </div>
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
import {axiosGet} from "../../../../../../common/Helper/AxiosHelper";

export default {
    name: "EmployeeEducationEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        url: {},
    },
    data() {
        return {
            TENANT_SELECTABLE_EDUCATIONAL_INSTITUTION,
            TENANT_SELECTABLE_EDUCATION,
            formData: {
                location: '',
            },
            errors: {},
            preloader: false,
        }
    },
    methods: {
        submitData() {
            this.loading = true;
            this.save(this.formData)
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