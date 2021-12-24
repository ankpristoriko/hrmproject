<template>
    <div>
        <app-overlay-loader v-if="preloader"/>
        <template v-else>
            <div class="row mb-primary" v-for="workExperience in workExperiences">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="file-text"/>
                            </div>
                        </div>
                        {{ workExperience.value.job_title }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <template>
                            {{ workExperience.value.company_name }}
                    </template>
                    <br />
                    <template>
                            {{ workExperience.value.location }}
                    </template>
                    <br />
                    <template>
                            {{ workExperience.value.start_date }} - {{ workExperience.value.end_date }} 
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
                                    v-if="$can('update_employee_work_experiences')"
                                    @click="editModal(workExperience.id)">
                                <app-icon name="edit"/>
                            </button>
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('delete')"
                                    v-if="$can('delete_employee_work_experiences')"
                                    @click="getConfirmations(workExperience.id)">
                                <app-icon name="trash-2"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" v-if="$can('create_employee_work_experiences')">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="file-plus"/>
                            </div>
                        </div>
                        {{ $t('work_experience') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <p class="text-muted mb-0">
                        {{ $t('you_can_add_multiple_work_experiences') }}
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

        <app-employee-work-experience-modal
            v-if="isModalActive"
            v-model="isModalActive"
            @close="isModalActive = false"
            :selected-url="selectedUrl"
            @reload="getWorkExperiences"
            :url="url"
        />
        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="deleteModal"
            @cancelled="cancelled"
            :reload="getWorkExperiences()"
        />
    </div>
</template>

<script>
import {axiosGet, axiosDelete} from "../../../../../../common/Helper/AxiosHelper";
import WorkExperienceDetails from "./Components/WorkExperienceDetails";

export default {
    name: "WorkExperiences",
    components: {WorkExperienceDetails},
    props: ['props'],
    data() {
        return {
            confirmationModalActive: false,
            preloader: true,
            workExperiences: [],
            isModalActive: false,
            selectedUrl: '',
            deletedUrl: ''
        }
    },
    mounted() {
        this.getWorkExperiences();
    },
    methods: {
        getWorkExperiences() {
            axiosGet(this.url).then(({data}) => {
                this.workExperiences = data;
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
        editModal(workExperienceId) {
            this.selectedUrl = `${this.url}/${workExperienceId}`;
            this.openModal();
        },
        deleteModal() {
            axiosDelete(this.deletedUrl).then(({data}) => {
                this.$toastr.s('', data.message);
                this.deletedUrl = '';
                this.confirmationModalActive = false;
                // this.$emit('reload');
                this.getWorkExperiences();
            }).catch((error) => {
                if (error.response)
                    this.toastException(error.response.data)
            });
        },
        getConfirmations(workExperienceId) {
            this.deletedUrl = `${this.url}/${workExperienceId}`;
            this.confirmationModalActive = true;
        },
        cancelled() {
            this.confirmationModalActive = false;
        },
    },
    computed: {
        url() {
            return `${this.apiUrl.EMPLOYEES}/${this.props.id}/work-experiences`;
        }
    }
}
</script>