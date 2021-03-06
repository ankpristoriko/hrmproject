<template>
    <div>
        <app-overlay-loader v-if="preloader"/>
        <form v-else ref="form">
            <app-form-group
                page="page"
                :label="$t('first_name')"
                type="text"
                :required="true"
                v-model="formData.first_name"
                :placeholder="$placeholder('first_name','')"
                :error-message="$errorMessage(errors, 'first_name')"
            />
            <app-form-group
                page="page"
                :label="$t('last_name')"
                type="text"
                :required="true"
                v-model="formData.last_name"
                :placeholder="$placeholder('last_name','')"
                :error-message="$errorMessage(errors, 'last_name')"
            />
            <app-form-group
                page="page"
                :label="$t('email')"
                type="text"
                :required="true"
                v-model="formData.email"
                :placeholder="$placeholder('email','')"
                :error-message="$errorMessage(errors, 'email')"
            />
            <app-form-group
                page="page"
                :label="$t('employee_id')"
                type="text"
                :required="true"
                v-model="formData.employee_id"
                :placeholder="$placeholder('employee_id','')"
                :error-message="$errorMessage(errors, 'employee_id', true, true)"
            />
            <app-form-group
                page="page"
                :label="$t('phone_number')"
                type="tel-input"
                v-model="formData.phone_number"
                :placeholder="$placeholder('phone_number','')"
                :error-message="$errorMessage(errors, 'phone_number')"
            />
            <app-form-group
                page="page"
                :label="$t('gender')"
                type="radio"
                :list="[
                {id:'male',value: $t('male')},
                {id:'female', value:  $t('female')},
                {id:'other', value:  $t('others')}
            ]"
                v-model="formData.gender"
                :error-message="$errorMessage(errors, 'gender')"
            />

            <app-form-group
                page="page"
                :label="$t('marital_status')"
                type="select"
                v-model="formData.marital_status"
                :list="getMaritalStatus"
                :placeholder="$placeholder('marital_status', '')"
                :error-message="$errorMessage(errors, 'marital_status')"
            />

            <app-form-group
                page="page"
                :label="$t('number_of_children')"
                type="text"
                :required="true"
                v-model="formData.number_of_children"
                :placeholder="$placeholder('number_of_children','')"
                :error-message="$errorMessage(errors, 'number_of_children', true, true)"
            />
                    
            <app-form-group
                page="page"
                type="search-select"
                list-value-field="value"
                :label="$t('nationality')"
                :chooseLabel="$t('nationality')"
                v-model="formData.nationality"
                :list="countries"
                :error-message="$errorMessage(errors, 'nationality')"
            />

            <app-form-group-selectable
                page="page"
                type="search-select"
                :label="$t('religion')"
                list-value-field="name"
                :chooseLabel="$t('religion')"
                v-model="formData.religion_id"
                :error-message="$errorMessage(errors, 'religion_id')"
                :fetch-url="`${TENANT_SELECTABLE_RELIGION}`"
            />

            <app-form-group-selectable
                page="page"
                type="search-select"
                :label="$t('ethnicity')"
                list-value-field="name"
                :chooseLabel="$t('ethnicity')"
                v-model="formData.ethnicity_id"
                :error-message="$errorMessage(errors, 'ethnicity_id')"
                :fetch-url="`${TENANT_SELECTABLE_ETHNICITY}`"
            />

            <app-form-group
                page="page"
                :label="$t('birthday')"
                type="date"
                v-model="formData.date_of_birth"
                :placeholder="$placeholder('date_of_birth','')"
                :error-message="$errorMessage(errors, 'date_of_birth')"
            />
            <app-form-group
                page="page"
                :label="$t('about_me')"
                type="textarea"
                v-model="formData.about_me"
                :placeholder="$textAreaPlaceHolder('about_me','')"
                :error-message="$errorMessage(errors, 'about_me')"
            />
            <div class="form-group mt-5 mb-0">
                <app-submit-button @click="submitData" :title="$t('save')" :loading="loading"/>
            </div>
        </form>
    </div>

</template>
<script>
import FormHelperMixins from "../../../../../../common/Mixin/Global/FormHelperMixins";
import {formatDateForServer} from "../../../../../../common/Helper/Support/DateTimeHelper";
import {mapState} from "vuex";
import {EMPLOYEES} from "../../../../../Config/ApiUrl";
import optional from "../../../../../../common/Helper/Support/Optional";
import {addSelectInSelectArray, addChooseInSelectArray} from "../../../../../../common/Helper/Support/FormHelper";
import {TENANT_SELECTABLE_RELIGION, TENANT_SELECTABLE_ETHNICITY} from "../../../../../../common/Config/apiUrl";
import countries from "../../Helper/countries";

export default {
    name: "EmployeePersonalDetails",
    mixins: [FormHelperMixins],
    data() {
        return {
            TENANT_SELECTABLE_RELIGION,
            TENANT_SELECTABLE_ETHNICITY,
            formData: {},
            preloader: true
        }
    },
    methods: {
        submitData() {
            this.loading = true;
            const formData = {...this.formData};
            formData.date_of_birth = formatDateForServer(formData.date_of_birth);
            this.submitFromFixin(`patch`, `${EMPLOYEES}/${this.formData.id}/profile-update`, formData);
        },
        afterSuccess(response) {
            this.loading = false;
            this.$toastr.s('', response.data.message);
            this.scrollToTop(false)
            // setTimeout(() => location.reload())
        },
    },

    computed: {
        ...mapState({
            employeeDetails: state => state.employees.employee
        }),
        getMaritalStatus() {
            return addSelectInSelectArray([
                {id: 'single', value: this.$t('single')},
                {id: 'married', value: this.$t('married')},
                {id: 'widowed', value: this.$t('widowed')},
                {id: 'divorced', value: this.$t('divorced')},
            ], 'value', 'marital_status');
        },
        countries() {
            return addChooseInSelectArray(countries, 'value', this.$t('country'))
        }
    },

    watch: {
        employeeDetails: {
            handler: function (employee) {
                if (!!Object.keys(employee).length) {
                    this.preloader = false
                }

                this.formData = {
                    ...employee,
                    employee_id: employee.profile ? employee.profile.employee_id : '',
                    gender: employee.profile ? employee.profile.gender : '',
                    about_me: employee.profile ? employee.profile.about_me : '',
                    phone_number: employee.profile ? employee.profile.phone_number : '',
                    marital_status: employee.profile ? employee.profile.marital_status : '',
                    number_of_children: employee.profile ? employee.profile.number_of_children : '',
                    nationality: employee.profile ? employee.profile.nationality : '',
                    religion_id: employee.profile ? employee.profile.religion_id : '',
                    ethnicity_id: employee.profile ? employee.profile.ethnicity_id : '',
                    date_of_birth: optional(employee, 'profile', 'date_of_birth') ? new Date(employee.profile.date_of_birth) : ''
                }
            },
            deep: true,
            immediate: true
        }
    }
}
</script>