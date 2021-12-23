<template>       
    <div class="mb-primary">
        <app-tab :tabs="tabsQualification" type="horizontal"/>
    </div>
</template>
<script>
export default {
    name: "Qualification",
    props: ['props'],
    data() {
        return {
            tabsQualification: [
                {
                    'name': this.$t('educations'),
                    'title': this.$t('educations'),
                    'component': 'app-employee-education',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('licenses'),
                    'title': this.$t('licenses'),
                    'component': 'app-employee-license',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('work_experiences'),
                    'title': this.$t('work_experiences'),
                    'component': 'app-employee-work-experience',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('training_histories'),
                    'title': this.$t('training_histories'),
                    'component': 'app-employee-training-history',
                    'props': {
                        id: this.props.id
                    }
                },
            ],
        }
    },
}
</script>