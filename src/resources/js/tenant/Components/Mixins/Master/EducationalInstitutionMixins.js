import {EDUCATIONAL_INSTITUTIONS} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: EDUCATIONAL_INSTITUTIONS,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('name'),
                        type: 'text',
                        key: 'name',
                        isVisible: true,
                    },
                    {
                        title: this.$t('address'),
                        type: 'text',
                        key: 'address',
                        isVisible: true,
                    },
                    {
                        title: this.$t('actions'),
                        type: 'action',
                        isVisible: true
                    },
                ],
                filters: [
                    {
                        title: this.$t('created'),
                        type: "range-picker",
                        key: "date",
                        option: ["today", "thisMonth", "last7Days", "thisYear"]
                    },
                ],
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: true,
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-educational-institution-modal',
                        modalId: 'educational-institution-modal',
                        url: EDUCATIONAL_INSTITUTIONS,
                        name: 'edit',
                        modifier: row => this.$can('update_educational_institutions')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: EDUCATIONAL_INSTITUTIONS,
                        modifier: row => this.$can('delete_educational_institutions')
                    },
                ],
            }
        }
    }
}
