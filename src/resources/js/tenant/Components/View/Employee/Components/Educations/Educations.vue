<template>
    <div>
        <app-overlay-loader v-if="preloader"/>
        <template v-else>
            <div class="row mb-primary" v-for="education in educations">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="user"/>
                            </div>
                        </div>
                        {{ education.value.name }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <template v-if="education.value">
                        <education-details :value="education.value" identifier="education_level" icon="clipboard"/>
                    </template>
                </div>
                <div class="col-lg-3">
                    <div class="text-right mt-3 mt-lg-0">
                        <div class="btn-group btn-group-action" role="group"
                             aria-label="Default action">
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('edit')"
                                    v-if="$can('update_employee_educations')"
                                    @click="editModal(education.id)">
                                <app-icon name="edit"/>
                            </button>
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('delete')"
                                    v-if="$can('delete_employee_educations')"
                                    @click="getConfirmations(education.id)">
                                <app-icon name="trash-2"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" v-if="$can('create_employee_educations')">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="file-plus"/>
                            </div>
                        </div>
                        {{ $t('education') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <p class="text-muted mb-0">
                        {{ $t('you_can_add_multiple_educations') }}
                    </p>
                </div>
                <div class="col-lg-3">
                    <div class="text-right">
                        <button class="btn btn-primary" @click="addModal" >
                            {{ $t('add') }}
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <app-employee-education-modal
            v-if="isModalActive"
            v-model="isModalActive"
            @close="isModalActive = false"
            :selected-url="selectedUrl"
            @reload="getEducations"
            :url="url"
        />
        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="deleteModal"
            @cancelled="cancelled"
            :reload="getEducations()"
        />
    </div>
</template>

<script>
import {axiosGet, axiosDelete} from "../../../../../../common/Helper/AxiosHelper";
import EducationDetails from "./Components/EducationDetails";

export default {
    name: "Educations",
    components: {EducationDetails},
    props: ['props'],
    data() {
        return {
            confirmationModalActive: false,
            preloader: true,
            educations: [],
            isModalActive: false,
            selectedUrl: '',
            deletedUrl: ''
        }
    },
    mounted() {
        this.getEducations();
    },
    methods: {
        getEducations() {
            axiosGet(this.url).then(({data}) => {
                this.educations = data;
            }).finally(() => {
                this.preloader = false;
            });
        },
        openModal() {
            this.isModalActive = true;
        },
        addModal() {
            this.selectedUrl = '';
            this.openModal();
        },
        editModal(educationId) {
            this.selectedUrl = `${this.url}/${educationId}`;
            this.openModal();
        },
        deleteModal() {
            axiosDelete(this.deletedUrl).then(({data}) => {
                this.$toastr.s('', data.message);
                this.deletedUrl = '';
                this.confirmationModalActive = false;
                this.$emit('reload');
            }).catch((error) => {
                if (error.response)
                    this.toastException(error.response.data)
            });
        },
        getConfirmations(educationId) {
            this.deletedUrl = `${this.url}/${educationId}`;
            this.confirmationModalActive = true;
        },
        cancelled() {
            this.confirmationModalActive = false;
        },
    },
    computed: {
        url() {
            return `${this.apiUrl.EMPLOYEES}/${this.props.id}/educations`;
        }
    }
}
</script>