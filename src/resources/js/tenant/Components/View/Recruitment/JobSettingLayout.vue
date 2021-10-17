<template>
    <div class="content-wrapper">
        <app-breadcrumb :page-title="pageTitle" :icon="pageIcon"/>
        <app-tab :tabs="tabs" :icon="pageIcon"/>
    </div>
</template>

<script>
    export default {
        name: "JobSettingLayout",
        props: {
            permissions: {}
        },
        data() {
            return {
                pageTitle: 'Job Settings',
                pageIcon: 'grid',
                tabs: [
                    {
                        name: this.$t('application_form'),
                        title: this.$t('application_form'),
                        component: 'application-form-setting',
                        permission: this.$can('permission_manage_global_application_form'),
                    },
                    {
                        name: this.$t('job_type'),
                        title: this.$t('job_type'),
                        component: "app-job-types",
                        permission: this.$can('view_job_types'),
                        headerButton: this.$can('create_job_types') ? {
                            label: this.$t('add_job_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('event_type'),
                        title: this.$t('event_type'),
                        component: "app-event-types",
                        permission: this.$can('view_event_types'),
                        headerButton: this.$can('create_event_types') ? {
                            label: this.$t('add_event_type'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                    {
                        name: this.$t('stage'),
                        title: this.$t('stage'),
                        component: "app-stages",
                        permission: this.$can('view_stages'),
                        headerButton: this.$can('create_stages') ? {
                            label: this.$t('add_stage'),
                            class: 'btn btn-primary'
                        } : {}
                    },
                ]
            }
        },
    }
</script>
