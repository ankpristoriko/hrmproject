export const PromotionTableHelpers = {
    data() {
        return {
            tableColumns : [
                {
                    title: this.$t('promotion_employee'),
                    type: 'object',
                    key: 'promotion_employee',
                    modifier: (value, row) => {
                        return row.employee.first_name + ' ' + row.employee.last_name
                    }
                },
                // {
                //     title: this.$t('company_name'),
                //     type: 'object',
                //     key: 'company_name',
                //     modifier: (value, row) => {
                //         return row.company.company_name
                //     }
                // },
                {
                    title: this.$t('promotion_title'),
                    type: 'text',
                    key: 'promotion_title',
                },
                {
                    title: this.$t('promotion_date'),
                    type: 'text',
                    key: 'promotion_date',
                },
                
            ],
            actionObj : {
                title: this.$t('action'),
                type: 'action',
            }
        }
    },
}