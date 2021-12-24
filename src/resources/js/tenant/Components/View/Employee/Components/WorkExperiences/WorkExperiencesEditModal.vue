<template>
    <modal id="employee-work-experience-modal"
           size="large"
           v-model="showModal"
           :title="generateModalTitle('work_experience')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form"
              :data-url="selectedUrl ? selectedUrl : url"
              @submit.prevent="submitData">
            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('company_name')"
                        :placeholder="$placeholder('company_name')"
                        v-model="formData.company_name"
                        :error-message="$errorMessage(errors, 'company_name')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('company_description')"
                        :placeholder="$placeholder('company_description')"
                        v-model="formData.company_description"
                        :error-message="$errorMessage(errors, 'company_description')"
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
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('job_title')"
                        :placeholder="$placeholder('job_title')"
                        v-model="formData.job_title"
                        :error-message="$errorMessage(errors, 'job_title')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('job_description')"
                        :placeholder="$placeholder('job_description')"
                        v-model="formData.job_description"
                        :error-message="$errorMessage(errors, 'job_description')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                            :label="$fieldTitle('start_date', '')"
                            :id="'start_date'"
                            type="date"
                            v-model="formData.start_date"
                            :placeholder="$placeholder('start_date', '')"
                            :required="true"
                            :error-message="$errorMessage(errors, 'start_date')"
                        />
                </div>
                <div class="col-md-6">
                    <app-form-group
                            :label="$fieldTitle('end_date', '')"
                            :id="'end_date'"
                            type="date"
                            v-model="formData.end_date"
                            :placeholder="$placeholder('end_date', '')"
                            :required="true"
                            :error-message="$errorMessage(errors, 'end_date')"
                        />
                </div>

                <div class="col-md-12">
                    <app-form-group
                        :label="$t('last_salary')"
                        :placeholder="$placeholder('last_salary')"
                        v-model="formData.last_salary"
                        :required="true"
                        :error-message="$errorMessage(errors, 'last_salary')"
                    />
                    <app-form-group
                        :label="$t('reason_of_leaving')"
                        :placeholder="$placeholder('reason_of_leaving')"
                        v-model="formData.reason_of_leaving"
                        :required="true"
                        :error-message="$errorMessage(errors, 'reason_of_leaving')"
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
import {formatDateForServer} from "../../../../../../common/Helper/Support/DateTimeHelper";

export default {
    name: "EmployeeWorkExperienceEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        url: {},
    },
    data() {
        return {
            formData: {
                start_date: '',
                end_date: '',
            },
            errors: {},
            preloader: false,
        }
    },
    methods: {
        submitData() {
            let formData = {...this.formData};

            formData.start_date = formatDateForServer(this.formData.start_date);
            formData.end_date = formatDateForServer(this.formData.end_date);

            this.loading = true;
            this.save(formData)
        },
        afterSuccess({data}) {
            this.loading = false;
            $('#employee-work-experience-modal').modal('hide');
            this.$toastr.s('', data.message);
            this.$emit('reload')
        },
        afterSuccessFromGetEditData({data}) {
            this.preloader = false;
            this.formData = data;
            this.formData = flatObjectWithKey(this.formData, 'value');
        },
    },
}
</script>