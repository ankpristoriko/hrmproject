<template>
    <div>
        <app-overlay-loader v-if="preloader"/>
        <template v-else>
            <single-document :document="employeeDocument.ktp"
                            type="ktp"
                            @add="openModal"
                            @edit="openModal"
                            @delete="getConfirmations"
            />

            <single-document :document="employeeDocument.npwp"
                            type="npwp"
                            @add="openModal"
                            @edit="openModal"
                            @delete="getConfirmations"
            />

            <single-document :document="employeeDocument.bpjs_ketenagakerjaan"
                            type="bpjs_ketenagakerjaan"
                            @add="openModal"
                            @edit="openModal"
                            @delete="getConfirmations"
            />

            <single-document :document="employeeDocument.bpjs_kesehatan"
                            type="bpjs_kesehatan"
                            @add="openModal"
                            @edit="openModal"
                            @delete="getConfirmations"
            />
        </template>

        <app-employee-document-modal
            v-if="isModalActive"
            v-model="isModalActive"
            :title="title"
            :document="getDocument(title)"
            @close="isModalActive = false"
            @reload="getDocuments()"
            :url="url"
        />

        <app-confirmation-modal
                v-if="confirmationModalActive"
                icon="trash-2"
                modal-id="app-confirmation-modal"
                @confirmed="deleteModal"
                @cancelled="cancelled"
                :reload="getDocuments()"
        />
    </div>
</template>

<script>
import {axiosGet, axiosDelete} from "../../../../../../common/Helper/AxiosHelper";
import SingleDocument from "./Components/SingleDocument";

export default {
    name: "AppDocuments",
    props: ['props'],
    components: {SingleDocument},
    data() {
        return {
            confirmationModalActive: false,
            documents: [],
            preloader: true,
            isModalActive: false,
            title: '',
        }
    },
    mounted() {
        this.getDocuments();
    },
    methods: {
        getDocuments() {
            axiosGet(this.url).then(({data}) => {
                this.documents = data;
            }).finally(() => {
                this.preloader = false;
            });
        },
        openModal(type) {
            this.isModalActive = true;
            this.title = type;
        },
        getDocument(type) {
            return this.documents.find(document => document.key === type) || {}
        },
        deleteModal() {
            axiosDelete(`${this.url}/${this.title}`).then(({data}) => {
                this.$toastr.s('', data.message);
                this.$emit('reload')
                this.confirmationModalActive = false;
            }).catch((error) => {
                if (error.response)
                    this.toastException(error.response.data)
            });
        },
        getConfirmations(type){
            this.title = type;
            this.confirmationModalActive = true;
        },
        cancelled() {
            this.confirmationModalActive = false;
        },
    },
    computed: {
        employeeDocument() {
            return  {
                ktp: this.getDocument('ktp'),
                npwp: this.getDocument('npwp'),
                bpjs_ketenagakerjaan: this.getDocument('bpjs_ketenagakerjaan'),
                bpjs_kesehatan: this.getDocument('bpjs_kesehatan'),
            };
        },
        url() {
            return `${this.apiUrl.EMPLOYEES}/${this.props.id}/documents`;
        }
    }
}
</script>