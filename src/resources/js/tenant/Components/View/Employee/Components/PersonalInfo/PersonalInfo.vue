<template>       
    <div class="mb-primary">
        <app-tab :tabs="tabsPersonalInfo" type="horizontal"/>
    </div>
</template>
<script>
export default {
    name: "PersonalInfo",
    props: ['props'],
    data() {
        return {
            tabsPersonalInfo: [
                {
                    'name': this.$t('address_details'),
                    'title': this.$t('address_details'),
                    'component': 'app-employee-address-details',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('emergency_contacts'),
                    'title': this.$t('emergency_contacts'),
                    'component': 'app-employee-emergency-contact',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('documents'),
                    'title': this.$t('documents'),
                    'component': 'app-employee-document',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('work_permits'),
                    'title': this.$t('work_permits'),
                    'component': 'app-employee-work-permit',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('dependents'),
                    'title': this.$t('dependents'),
                    'component': 'app-employee-dependent',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('bank_accounts'),
                    'title': this.$t('bank_accounts'),
                    'component': 'app-employee-bank-account',
                    'props': {
                        id: this.props.id
                    }
                },
                {
                    'name': this.$t('social_links'),
                    'title': this.$t('social_links'),
                    'component': 'app-employee-social-link',
                    'props': {
                        id: this.props.id
                    }
                },
            ],
        }
    },
}
</script>