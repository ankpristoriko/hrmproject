<template>
    <div class="mb-primary">
        <app-tab :tabs="tabsParameterSettings" type="horizontal"/>
    </div>
</template>

<script>
export default {
    name: "ParameterSetting",
    data() {
        return {
            tabsParameterSettings: [
                {
                    'name': this.$t('system_parameter'),
                    'title': this.$t('system_parameter'),
                    'component': 'app-system-parameter-settings',
                    'headerButton': {
                            'label': this.$addLabel('system_parameter'),
                            'class': 'btn btn-primary'
                            }
                },
                {
                    'name': this.$t('bpjs_parameter'),
                    'title': this.$t('bpjs_parameter'),
                    'component': 'app-bpjs-parameter-settings',
                    'headerButton': {
                            'label': this.$addLabel('bpjs_parameter'),
                            'class': 'btn btn-primary'
                            }
                },
                {
                    'name': this.$t('tax_bracket'),
                    'title': this.$t('tax_bracket'),
                    'component': 'app-tax-bracket-settings',
                    'headerButton': {
                            'label': this.$addLabel('tax_bracket'),
                            'class': 'btn btn-primary'
                            }
                },
                {
                    'name': this.$t('non_npwp_tax_bracket'),
                    'title': this.$t('non_npwp_tax_bracket'),
                    'component': 'app-non-npwp-tax-bracket-settings',
                    'headerButton': {
                            'label': this.$addLabel('non_npwp_tax_bracket'),
                            'class': 'btn btn-primary'
                            }
                },
                {
                    'name': this.$t('pension_tax_bracket'),
                    'title': this.$t('pension_tax_bracket'),
                    'component': 'app-pension-tax-bracket-settings',
                    'headerButton': {
                            'label': this.$addLabel('pension_tax_bracket'),
                            'class': 'btn btn-primary'
                            }
                },
                {
                    'name': this.$t('severance_pay_tax_bracket'),
                    'title': this.$t('severance_pay_tax_bracket'),
                    'component': 'app-severance-pay-tax-bracket-settings',
                    'headerButton': {
                            'label': this.$addLabel('severance_pay_tax_bracket'),
                            'class': 'btn btn-primary'
                            }
                },
            ],
        }
    },
}
</script>